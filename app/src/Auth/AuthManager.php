<?php


namespace BS\Auth;


use BS\Main\Application;
use BS\Main\Request;
use BS\Models\User;
use BS\Models\ValidateException;

class AuthManager
{

    /**
     * @var Request
     */
    private $request;

    private $lastHash;
    private $currentHash;
    private $arUser;

    private $arErrors = [];

    public function __construct()
    {
        $this->request = Application::getInstance()->getRequest();
        $this->lastHash = $this->request->filter('AUTH_HASH', 'session', FILTER_SANITIZE_STRING);
        $this->currentHash = Hasher::client();

        $this->loginByHash();
    }

    private function loginById($id)
    {
        $this->logout();
        $arUser = User::getById($id);
        $this->loginInternal($arUser);
    }

    private function loginByHash()
    {
        $this->logout();
        if ($this->checkCsrf()) {
            $arUser = User::getByHash($this->currentHash);
            $this->loginInternal($arUser);
        } else {
            $_SESSION['AUTH_HASH'] = $this->currentHash;
        }
    }

    private function loginInternal($arUser)
    {
        if ($arUser['ID']) {
            if (!$this->checkCsrf()) {
                User::update(['ID' => $arUser['ID']], ['HASH' => $this->currentHash]);
            }

            $_SESSION['AUTH_HASH'] = $this->currentHash;
            $arUser['HASH'] = $this->currentHash;
            $this->arUser = $arUser;
        }
    }

    public function logout($redirect = ""): void
    {
        $_SESSION['AUTH_HASH'] = "";

        if ($redirect != "") {
            Application::getInstance()->getRouter()->getResponse()
                ->redirect('/', 307);
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

    public function getCsrf(): string
    {
        return $this->currentHash;
    }

    public function checkCsrf(string $csrf = null): bool
    {
        if (!$csrf) {
            $csrf = $this->lastHash;
        }

        return $csrf === $this->currentHash;
    }
}
