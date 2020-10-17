<?php


namespace BS\Auth;


use BS\Facades\Auth;
use BS\Facades\File;
use BS\Main\Application;
use BS\Main\Request;
use BS\Models\User;
use BS\Models\ValidateException;
use Exception;

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
        if ($this->checkCsrf()) {
            $arUser = User::getByHash($this->currentHash);
            $this->loginInternal($arUser);
        } else {
            $this->logout();
        }
    }

    private function loginInternal($arUser): int
    {
        if ($arUser['ID']) {
            if (!$this->checkCsrf()) {
                User::update(
                    [
                        ['ID', '=', $arUser['ID']]
                    ],
                    ['HASH' => $this->currentHash]
                );
            }
            $arUser['HASH'] = $this->currentHash;
            $this->arUser = $arUser;
        }

        $_SESSION['AUTH_HASH'] = $this->currentHash;
        return (int)$arUser['ID'] ?? 0;
    }

    public function logout($redirect = ""): void
    {
        $_SESSION['AUTH_HASH'] = "";

        if ($redirect != "") {
            Application::getInstance()->getRouter()->getResponse()
                ->redirect($redirect, 307);
        }
    }

    public function login($login, $password): int
    {
        $arUser = User::getFirst(
            [
                ['EMAIL', '=', $login],
                ['PASSWORD', '=', Hasher::register($password)]
            ]
        );
        return $this->loginInternal($arUser);
    }

    public function register(array $arFields)
    {
        $arUser = $arFields['fields'];

        if (!Auth::checkCsrf($arFields['csrf'])) {
            $this->arErrors['csrf'][] = 'Ошибка доступа';
        }

        if (trim($arUser['PASSWORD']) == "") {
            $this->arErrors['PASSWORD'][] = 'Пароль не может быть пустым';
        }
        if (trim($arFields['PASSWORD2']) == "") {
            $this->arErrors['PASSWORD2'][] = 'Подтверждение пароля не может быть пустым';
        }
        if ($arUser['PASSWORD'] !== $arFields['PASSWORD2']) {
            $passwordsError = 'Пароли не совпадают';
            $this->arErrors['PASSWORD'][] = $passwordsError;
            $this->arErrors['PASSWORD2'][] = $passwordsError;
        }

        if (User::getByEmail($arUser['EMAIL'])) {
            $this->arErrors['EMAIL'][] = 'Пользователь с таким email существует';
        }

        $arUser['PASSWORD'] = Hasher::register($arUser['PASSWORD']);
        $arUser['HASH'] = $arFields['csrf'];

        if ($this->request->has('AVATAR', 'files')) {
            try {
                $arUser['AVATAR'] = File::uploadImage(
                    $this->request->file('AVATAR')[0],
                    User::getTableName(),
                    ['w' => 100, 'h' => 100]
                );
            } catch (Exception $e) {
                $this->arErrors['AVATAR'][] = $e->getMessage();
            }
        }
        if ($this->request->has('GALLERY', 'files')) {
            try {
                foreach ($this->request->file('GALLERY') as $arFile) {
                    $arUser['GALLERY'][] = File::uploadImage(
                        $arFile,
                        User::getTableName(),
                        ['w' => 500]
                    );
                }
            } catch (Exception $e) {
                $this->arErrors['GALLERY'][] = $e->getMessage();
            }
        }

        $userId = 0;
        if (empty($this->arErrors)) {
            try {
                $userId = User::create($arUser);
            } catch (ValidateException $e) {
                $this->arErrors += unserialize($e->getMessage());
            }
        }

        $arResult = [
            'SUCCESS' => false,
            'RESULT'  => $userId,
            'ERRORS'  => []
        ];

        if ($userId == 0) {
            $this->arErrors[] = ["При регистрации возникли ошибки"];
        }

        if ($this->arErrors) {
            $arResult['ERRORS'] = $this->arErrors;
            return $arResult;
        }

        $this->loginById($userId);
        $arResult['SUCCESS'] = true;

        return $arResult;
    }

    public function check(): bool
    {
        return (int)$this->arUser['ID'] > 0;
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

    public function checkCsrf(?string $csrf = null): bool
    {
        if (!$csrf) {
            $csrf = $this->lastHash;
        }

        return $csrf === $this->currentHash;
    }
}
