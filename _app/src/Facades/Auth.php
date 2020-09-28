<?php


namespace BS\Facades;

use BS\Auth\AuthManager;

/**
 * @method static bool register(array $arFields)
 * @method static bool check()
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
