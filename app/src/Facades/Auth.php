<?php


namespace BS\Facades;

use BS\Auth\AuthManager;

/**
 * @method static void logout(string $redirect = "")
 * @method static void login(string $login, string $password)
 * @method static mixed register(array $arFields)
 * @method static bool check()
 * @method static bool isAdmin()
 * @method static array getUser()
 * @method static string getUserFullName()
 * @method static array getUserRoles()
 * @method static string getCsrf()
 * @method static bool checkCsrf(string $csrf = null)
 *
 * @see AuthManager
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }

    protected static function getFacadeClassname()
    {
        return AuthManager::class;
    }
}
