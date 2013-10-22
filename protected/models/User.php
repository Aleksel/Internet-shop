<?php

/**
 * This is the model class for table "yii_users".
 *
 * The followings are the available columns in table 'yii_users':
 * @property integer $id
 * @property string $email
 * @property string $passwd
 * @property string $name
 * @property string $surname
 * @property string $activationKey
 * @property string $status
 * @property string $createtime
 *
 * The followings are the available model relations:
 * @property Review[] $reviews
 */
class User extends CActiveRecord {

    const ROLE_ADMIN = 'administrator';
    const ROLE_MODER = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';

    public $verifyCode;
    public $passwd2;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'yii_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    // логин, пароль не должны быть больше 128-и символов, и меньше трёх
	    array('email, passwd', 'length', 'max' => 128, 'min' => 6),
	    array('surname, verifyCode', 'safe'),
		array('email', 'email'),
	    // логин, пароль не должны быть пустыми
	    array('email, passwd, passwd2, name', 'required', 'on' => 'registration, ajax'),
	    // для сценария registration поле passwd должно совпадать с полем passwd2
	    array('passwd2', 'compare', 'compareAttribute' => 'passwd', 'on' => 'registration, ajax'),
	    // правило для проверки капчи что капча совпадает с тем что ввел пользователь
	    array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'registration'),
	    array('email, passwd', 'authenticate', 'required', 'on' => 'login'),
	    array('email', 'match', 'pattern' => '/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', 'message' => 'Логин содержит недопустимые символы.'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'reviews' => array(self::HAS_MANY, 'Review', 'user_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'email' => 'E-mail',
	    'passwd' => 'Пароль',
	    'passwd2' => 'Подтверждение пароля',
	    'name' => 'Имя',
	    'surname' => 'Фамилия',
	    'activationKey' => 'Activation Key',
	    'status' => 'Status',
	    'createtime' => 'Createtime',
	);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
	// Warning: Please modify the following code to remove attributes that
	// should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id);
	$criteria->compare('email', $this->email, true);
	$criteria->compare('passwd', $this->passwd, true);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('surname', $this->surname, true);
	$criteria->compare('activationKey', $this->activationKey, true);
	$criteria->compare('status', $this->status, true);
	$criteria->compare('createtime', $this->createtime, true);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    public function authenticate($attribute, $params) {
	// Проверяем были ли ошибки в других правилах валидации.
	if (!$this->hasErrors()) {
	    // Создаем экземпляр класса UserIdentity передаем в его конструктор введенный пользователем логин и пароль
	    $identity = new UserIdentity($this->email, $this->passwd);
	    // Выполняем метод authenticate, он проверяет существует ли такой пользователь и возвращает ошибку (если она есть)
	    // в $identity->errorCode
	    $identity->authenticate();

	    // Теперь мы проверяем есть ли ошибка..
	    switch ($identity->errorCode) {
		// Если ошибки нету...
		case UserIdentity::ERROR_NONE: {
			// Выдаем пользователю соответствующие куки о том что он зарегистрирован, срок действий
			// у которых указан вторым параметром.
			Yii::app()->user->login($identity, 86400);
			break;
		}
		case UserIdentity::ERROR_UNKNOWN_IDENTITY: {
			// Если логин был указан наверно - создаем ошибку
			$this->addError('email', 'Пользователь или пароль указаны неверно!');
			break;
		}
		case UserIdentity::ERROR_AUTH_INVALID: {

			$this->addError('email', 'Ваш аккаунт еще не активирован, пожалуйста, проверьте вашу почту!');
			break;
		}
		case UserIdentity::ERROR_BANNED: {

			$this->addError('email', 'Ваш аккаунт заблокирован! Причины блокировки Вы можете узнать, связавшись с нами по адресу: '.Yii::app()->params['adminEmail']);
			break;
		}
	    }
	}
    }

}

