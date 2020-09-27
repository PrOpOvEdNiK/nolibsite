<?php


namespace BS\DB;

// todo: как-нибудь нужно доделать :)
class QueryBuilder
{
    /**
     * @var Connection
     */
    public $connection;

    /**
     * @var string
     */
    public $from;

    /**
     * @var array
     */
    public $bindings = [
        'select'     => [],
        'from'       => [],
        'join'       => [],
        'where'      => [],
        'groupBy'    => [],
        'having'     => [],
        'order'      => [],
        'union'      => [],
        'unionOrder' => [],
    ];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function from($table, $as = null)
    {

        $this->from = $as ? "{$table} as {$as}" : $table;
        return $this;
    }
}
