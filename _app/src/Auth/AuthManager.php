<?php


namespace BS\Auth;


use BS\Models\User;
use BS\Models\ValidateException;

class AuthManager
{
    private $arUser;

    private $arErrors = [];

    public function __construct()
    {
        $this->loginByHash($_SESSION['AUTH_HASH']);
    }

    private function loginById($id)
    {
        $this->logout();
        $arUser = User::getById($id);
        $this->loginInternal($arUser);
    }

    private function loginByHash($hash)
    {
        $this->logout();
        $clientHash = Hasher::client();
        if ($clientHash === $hash) {
            $arUser = User::getByHash($_SESSION['AUTH_HASH']);
            $this->loginInternal($arUser);
        }
    }

    private function loginInternal($arUser)
    {
        if ($arUser['ID']) {
            $clientHash = Hasher::client();

            if ($clientHash !== $_SESSION['AUTH_HASH']) {
                User::update(['ID' => $arUser['ID']], ['HASH' => $clientHash]);
            }

            $arUser['HASH'] = $clientHash;
            $this->arUser = $arUser;
            $_SESSION['AUTH_HASH'] = $arUser['HASH'];
        }
    }

    public function logout($redirect = ""): void
    {
        $_SESSION['AUTH_HASH'] = "";

        if ($redirect != "") {
            http_response_code("302 Moved Temporarily");
            header("Location: " . $redirect);
        }
    }

    public function login($login, $password): void
    {
        $password = Hasher::register($password);
        $arUser = User::getFirst(['EMAIL' => $login, 'PASSWORD' => $password]);
        $this->loginInternal($arUser);
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

        $arFields['PASSWORD'] = Hasher::register($arFields['PASSWORD']);
        $arFields['HASH'] = Hasher::client();

        $userId = 0;
        try {
            $userId = User::create($arFields);
        } catch (ValidateException $e) {
            $this->arErrors += unserialize($e->getMessage());
        }

        if ($userId == 0) {
            $this->arErrors[] = "Ошибка при создании пользователя";
        }

        if ($this->arErrors) {
            return $this->arErrors;
        }

        $this->loginById($userId);

        return $userId;
    }

    public function check(): bool
    {
        return intval($this->arUser['ID']) > 0;
    }

    public function getUser(): array
    {
        return $this->arUser;
    }

    public function getUserFullName(): string
    {
        return "{$this->arUser['LAST_NAME']} {$this->arUser['FIRST_NAME']} {$this->arUser['SECOND_NAME']}";
    }

    public function getUserRoles(): array
    {
        return $this->arUser['ROLES'] ?? [];
    }

    public function isAdmin(): bool
    {
        $arRoles = $this->getUserRoles();
        $arRolesSlugs = array_column($arRoles, 'SLUG');

        return in_array('webmaster', $arRolesSlugs);
    }

}
