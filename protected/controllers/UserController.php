<?php

/**
 * UserController
 *
 * Контроллер для наших пользователей. Содержит в себе следующие функции:
 * - авторизация
 * - регистрация
 * - выход
 * - редактирование профиля [в будущем]
 *
 * @version 1.0
 *
 */
class UserController extends CController
{

    public function actions()
    {
        return array(
            // Создаем экшинс captcha.
            // Он понадобиться нам для формы регистрации (да и авторизации)
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xF4F2DE,
                'maxLength' => 6,
                'minLength' => 4,
                'foreColor' => 0x8C8C8C,
            ),
        );
    }

    /**
     * Метод активации аккаунта
     */

    public function actionActivation($area = '')
    {
        if ($area !== '') {

            $user = User::model()->findByAttributes(array('activationKey' => $area));

            if (isset($user) and ($user->status === '0')) {
                $user->status = '1';
                $user->save();
                $this->render('activation_ok');

            } else
                throw new CHttpException(403, 'sss2');
        } else
            throw new CHttpException(403, 'sss');
    }


    /**
     * Метод входа на сайт
     *
     * Метод в котором мы выводим форму авторизации
     * и обрабатываем её на правильность.
     */
    public function actionLogin()
    {

        // Проверяем является ли пользователь гостем
        if (Yii::app()->user->isGuest) {

            $form = new User('login');

            if (!empty($_POST['User'])) {

                $form->attributes = $_POST['User'];

                // Проверяем правильность данных
                if ($form->validate('login')) {
                    // если всё ок - кидаем на главную страницу
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
            $this->render('login', array('model' => $form));
        } else {
            Yii::app()->user->setFlash('login_yet', 'Вы уже авторизованны');
            $this->render('login');
        }
    }

    /**
     * Метод выхода с сайта
     *
     * Данный метод описывает в себе выход пользователя с сайта
     * Т.е. кнопочка "выход"
     */
    public function actionLogout()
    {
        // Выходим
        Yii::app()->user->logout();
        // Перезагружаем страницу
        $this->redirect(Yii::app()->user->returnUrl);
    }


    /**
     * Метод обновления капчи при любой перезагрузке страницы
     *
     * @param string $view
     * @return bool
     */
    public function beforeRender($view)
    {

        $this->createAction('captcha')->getVerifyCode(True);
        return parent::beforeRender($view);

    }

    /**
     * Метод регистрации
     *
     * Выводим форму для регистрации пользователя и проверяем
     * данные которые придут от неё.
     * @throws CHttpException
     */
    public function actionRegistration()
    {

        if (Yii::app()->user->isGuest) {

            $user = new User('registration');

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {

                $user->setScenario('ajax'); //метод, устанавливающий сценарий 'ajax' для модели $comment, созданной выше
                /*
                 * Ajax валидация
                 */
                $this->performAjaxValidation($user);

            }

            if (empty($_POST['User'])) {
                /*
                 * Если форма не отправленна, то выводим форму
                 */
                $this->render('registration', array('model' => $user));
            } else {
                /*
                 * Форма получена
                 */
                $user->attributes = $_POST['User'];

                /*
                 * Валидация данных
                 */
                if ($user->validate()) {
                    /*
                     * Если проверка пройдена, проверяем на уникальность имя
                     * пользователя и e-mail
                     */
                    if ($user->model()->count("email = :email", array(':email' => $user->email))) {

                        $user->addError('email', 'E-mail уже занят');
                        $this->render("registration", array('model' => $user));
                    } else {
                        /*
                         * Если проверки пройдены шифруем пароль, генерируем код
                         * активации аккаунта, а также устанавливаем время регистрации
                         * и роль по умолчанию для пользователя
                         */
                        $user->passwd = md5(md5($user->passwd));
                        $user->passwd2 = md5(md5($user->passwd2));
                        $user->verifyCode = $_POST['User']['verifyCode'];
                        $user->activationKey = substr(md5(uniqid(rand(), true)), 0, rand(20, 20));
                        $user->status = '0';
                        $user->createtime = time();
                        $user->role = 'User';

                        /*
                         * Проверяем если добавление пользователя прошло успешно
                         * устанавливаем ему права.
                         */
                        if ($user->save()) {

                            $this->activationKey($user);
                            Yii::app()->user->setFlash('reg_ok', 'Спасибо! Регистрация прошла успешно. Вам на почту было отправлено письмо с кодом активации вашего аккаунта');
                            $this->render("registration");

                        } else {

                            throw new CHttpException(403, 'Ошибка, попробуйте позднее.');

                        }
                    }
                } else {
                    /*
                     * Не прошел валидацию
                     */
                    $this->render('registration', array('model' => $user));
                }
            }
        } else {
            /*
             * Если пользователь залогинен редиректим обратно
             */
            Yii::app()->user->setFlash('reg_ok', 'Вы уже зашли на сайт');
            $this->render("registration");
            //$this->redirect(Yii::app()->user->returnUrl);
        }
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     * Отправление кода активации
     *
     * @param $model
     */

    protected function activationKey($model)
    {

        $message = new YiiMailMessage;
        $message->setBody('Код активации аккаунта: <a href="' . Yii::app()->createAbsoluteUrl('/user/activation/' . $model->activationKey . '">' . $model->activationKey . '</a>'), 'text/html');
        $message->subject = 'Код активации аккаунта для сайта ' . Yii::app()->name;
        $message->addTo($model->email);
        $message->from = Yii::app()->params['adminEmail'];
        Yii::app()->mail->send($message);
    }

    /* if (!Yii::app()->user->id) {

      $form = new User('registration');

      if (isset($_POST['User'])) {

      $form->attributes = $_POST['User'];

      // Запоминаем данные которые пользователь ввёл в капче
      $form->verifyCode = $_POST['User']['verifyCode'];

      // В validate мы передаем название сценария.
      if ($form->validate('registration')) {

      // Если валидация прошла успешно...
      // Тогда проверяем свободен ли указанный логин..
      if ($form->model()->count("email = :email", array(':email' => $form->email))) {

      // Указанный логин уже занят. Создаем ошибку и передаем в форму
      $form->addError('email', 'данный e-mail уже зарегистрирован');
      $this->render("registration", array('form' => $form));
      } else {

      // Выводим страницу что "все окей"
      $form->save();
      Yii::app()->clientScript->registerScript('redirect', 'adr = "http://pet-like.ru"; setTimeout("window.location.href = adr" , 3000)', CClientScript::POS_READY);
      $this->render("registration_ok");
      }
      } else {

      // Если введенные данные противоречат
      // правилам валидации (указаны в rules) тогда
      // выводим форму и ошибки.
      $this->render("registration", array('form' => $form));
      }
      } else {

      // Если $_POST['User'] пустой массив - значит форму некто не отправлял.
      $this->render("registration", array('form' => $form));
      }
      } else {
      $this->render('login_yet');
      }
      }
     */
}

