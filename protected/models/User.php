<?php

class User extends CActiveRecord {


    public $name;

    public $surname;

    public $verifyCode;

    public $email;

    public $passwd;

    public $passwd2;
    
     public function attributeLabels()
    {
        return array(
            'email'=>'E-mail',
            'passwd'=>'Пароль',
            'passwd2'=>'Подтверждение пароля',
            'name'=>'Имя',
        );
    }
    
    public function rules() {
        return array(
            // логин, пароль не должны быть больше 128-и символов, и меньше трёх
            array('email, passwd', 'length', 'max' => 128, 'min' => 6),
            // логин, пароль не должны быть пустыми
            array('email, passwd, passwd2, name', 'required',  'on' => 'registration'),
            // для сценария registration поле passwd должно совпадать с полем passwd2
            array('passwd', 'compare', 'compareAttribute' => 'passwd2',  'on' => 'registration'),
            // правило для проверки капчи что капча совпадает с тем что ввел пользователь
            array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'),  'on' => 'registration'),
            array('email, passwd', 'authenticate', 'required', 'on' => 'login'),
            array('email', 'match', 'pattern' => '/^[A-Za-z0-9А-Яа-я\s,@.]+$/u', 'message' => 'Логин содержит недопустимые символы.'),
        );
    }

    public static function model($className = __CLASS__) 
    {
        return parent::model($className);
    }

    public function tableName() 
    {
        return 'yii_users';
    }
    
     public function authenticate($attribute, $params) {
        // Проверяем были ли ошибки в других правилах валидации.
        if (!$this->hasErrors()) 
        {
            // Создаем экземпляр класса UserIdentity передаем в его конструктор введенный пользователем логин и пароль
            $identity = new UserIdentity($this->email, $this->passwd);
            // Выполняем метод authenticate, он проверяет существует ли такой пользователь и возвращает ошибку (если она есть)
            // в $identity->errorCode
            $identity->authenticate();

            // Теперь мы проверяем есть ли ошибка..    
            switch ($identity->errorCode) 
            {
                // Если ошибки нету...
                case UserIdentity::ERROR_NONE: 
                {
                        // Выдаем пользователю соответствующие куки о том что он зарегистрирован, срок действий
                        // у которых указан вторым параметром. 
                        Yii::app()->user->login($identity, 86400);
                        break;
                }
                case UserIdentity::ERROR_UNKNOWN_IDENTITY: 
                {
                        // Если логин был указан наверно - создаем ошибку
                        $this->addError('email', 'Пользователь или пароль указаны неверно!');
                        break;
                }
            }
        }
    }

}

