<?php


namespace BS\Facades;


use RuntimeException;

abstract class Facade
{
    /**
     * @var array
     */
    protected static $resolvedInstances;

    public static function __callStatic(string $method, array $args)
    {
        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }

    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    protected static function getFacadeClassname()
    {
        throw new RuntimeException('Facade does not implement getFacadeClassname method.');
    }

    protected static function resolveFacadeInstance($name)
    {
        if (!isset(static::$resolvedInstances[$name])) {
            $className = static::getFacadeClassname();
            static::$resolvedInstances[$name] = new $className();
        }

        return static::$resolvedInstances[$name];
    }
}
