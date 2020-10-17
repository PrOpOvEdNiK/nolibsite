<?php


namespace BS\Facades;


/**
 * @method static int upload(array $arFile, string $model, array $arResize = [])
 * @method static int uploadImage(array $arFile, string $model, array $arResize = [])
 * @method static bool delete(int $id)
 *
 * @see \BS\Main\File
 */
class File extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'file';
    }

    protected static function getFacadeClassname()
    {
        return \BS\Main\File::class;
    }
}
