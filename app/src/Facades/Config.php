<?php


namespace BS\Facades;


/**
 * @method static mixed getValue(string $name)
 * @method static mixed getDsn()
 * @method static mixed getAppName()
 * @method static mixed getMode()
 *
 * @see \BS\Settings\Config
 */
class Config extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'config';
    }

    protected static function getFacadeClassname()
    {
        return \BS\Settings\Config::class;
    }
}
