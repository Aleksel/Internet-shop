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
class UserController extends CController {

    public function actions() {
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
     * Метод входа на сайт
     * 
     * Метод в котором мы выводим форму авторизации
     * и обрабатываем её на правильность.
     */
    public function actionLogin() {
        if (!Yii::app()->user->id) {
            $form = new User('login');

            // Проверяем является ли пользователь гостем
            if (!empty($_POST['User'])) {
                $form->attributes = $_POST['User'];

                // Проверяем правильность данных
                if ($form->validate('login')) {
                    // если всё ок - кидаем на главную страницу
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
            $this->render('login', array('form' => $form));
        } else {
            $this->render('login_yet');
        }
    }

    /**
     * Метод выхода с сайта
     * 
     * Данный метод описывает в себе выход пользователя с сайта
     * Т.е. кнопочка "выход"
     */
    public function actionLogout() {
        // Выходим
        Yii::app()->user->logout();
        // Перезагружаем страницу
        $this->redirect(Yii::app()->user->returnUrl);
    }

    /**
     * Метод регистрации
     *
     * Выводим форму для регистрации пользователя и проверяем
     * данные которые придут от неё.
     * @TODO aleksel Сделать автоматический вход после удачной регистрации
     */
    public function actionRegistration() {
        if (!Yii::app()->user->id) {
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

}

