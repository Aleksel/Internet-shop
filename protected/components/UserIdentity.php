<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    const ERROR_AUTH_INVALID=200;
    const ERROR_BANNED = 300;

    public function authenticate() {
        // Есть ли указанный пользователь в базе данных
        $record = User::model()->findByAttributes(array('email' => $this->username));

        if ($record === null)
        // Если нету - сохраняем в errorCode ошибку.
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;

        // Проверяем совпадает ли введенный пароль с тем что у нас в базе
        else if ($record->passwd !== md5(md5($this->password)))

            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;

        //Проверяем активирован ли аккаунт
        else if ($record->status === '0')

	$this->errorCode = self::ERROR_AUTH_INVALID;

        else if ($record->status === '2')

	$this->errorCode = self::ERROR_BANNED;

        else {
            // пароль был указан верно.
            $this->_id = $record->id;

	// В errorCode сохраняем что ошибок нет
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}