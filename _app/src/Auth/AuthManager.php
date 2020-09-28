<?php


namespace BS\Auth;


use BS\Models\User;
use BS\Models\ValidateException;

class AuthManager
{
    private const SALT_REGISTER = "awesomeregistersalt";

    private $session;
    private $user;

    private $arErrors = [];

    public function __construct()
    {
        $this->session = $_SESSION['AUTH'];

        if ($this->session['HASH']) {
            $this->user = ""; // get by hash
        }
    }

    public function register(array $arFields)
    {
        if (!$arFields['PASSWORD']) {
            $this->arErrors['PASSWORD'][] = 'Пароль не может быть пустым';
        }
        if (!$arFields['PASSWORD2']) {
            $this->arErrors['PASSWORD2'][] = 'Подтверждение пароля не может быть пустым';
        }
        if ($arFields['PASSWORD'] !== $arFields['PASSWORD2']) {
            $passwordsError = 'Пароли не совпадают';
            $this->arErrors['PASSWORD'][] = $passwordsError;
            $this->arErrors['PASSWORD2'][] = $passwordsError;
        }
        unset($arFields['PASSWORD2']);

        $arFields['PASSWORD'] = md5(md5($arFields['PASSWORD'] . self::SALT_REGISTER) . self::SALT_REGISTER);

        $userAgent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);
        $userIp = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);

        $hashSalt = md5($userAgent) . md5($userIp);
        $arFields['HASH'] = md5($hashSalt);

        $isCreated = false;
        try {
            $isCreated = User::create($arFields);
        } catch (ValidateException $e) {
            $this->arErrors += unserialize($e->getMessage());
        }

        if ($this->arErrors) {
            return $this->arErrors;
        }

        return $isCreated;
    }
}
