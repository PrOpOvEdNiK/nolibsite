<?php


namespace BS\Facades;

use BS\DB\Connection;

/**
 * @method static array prepareBindings(array $bindings)
 * @method static bool statement(string $query, array $bindings = [])
 * @method static int affectingStatement(string $query, array $bindings = [])
 * @method static array select(string $query, array $bindings = [])
 * @method static bool insert(string $query, array $bindings = [])
 * @method static bool delete(string $query, array $bindings = [])
 * @method static bool update(string $query, array $bindings = [])
 *
 * @see Connection
 */
class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'db';
    }

    protected static function getFacadeClassname()
    {
        return Connection::class;
    }
}
