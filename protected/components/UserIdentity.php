<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        // Есть ли указанный пользователь в базе данных
        $record = User::model()->findByAttributes(array('email' => $this->username));
        if ($record === null)
        // Если нету - сохраняем в errorCode ошибку.
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        else if ($record->passwd !== $this->password)
        // Проверяем совпадает ли введенный пароль с тем что у нас в базе
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
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