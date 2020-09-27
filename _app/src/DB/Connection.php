<?php


namespace BS\DB;


use BS\Settings\Config;
use DateTimeInterface;
use PDO;
use PDOStatement;

final class Connection
{
    /**
     * @var PDO
     */
    protected $PDO;

    public function __construct()
    {
        $arDsn = Config::getValue('connection');
        $dsn = "mysql:host={$arDsn['host']};dbname={$arDsn['database']};charset=utf8";

        $arPdoOptions = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
        ];

        $this->PDO = new PDO($dsn, $arDsn['user'], $arDsn['password'], $arPdoOptions);
    }

    public function prepareBindings(array $bindings)
    {
        foreach ($bindings as $key => $value) {
            if ($value instanceof DateTimeInterface) {
                $bindings[$key] = $value->format('Y-m-d H:i:s');
            } elseif (is_bool($value)) {
                $bindings[$key] = (int)$value;
            }
        }

        return $bindings;
    }

    public function bindValues(PDOStatement $statement, $bindings)
    {
        foreach ($bindings as $key => $value) {
            $statement->bindValue(
                is_string($key) ? $key : $key + 1,
                $value,
                is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR
            );
        }
    }

    protected function getPreparedStatment($query, $bindings = []): PDOStatement
    {
        $statement = $this->PDO->prepare($query);
        $this->bindValues($statement, $this->prepareBindings($bindings));

        return $statement;
    }

    public function statement($query, $bindings = []): bool
    {
        $statement = $this->getPreparedStatment($query, $bindings);

        return $statement->execute();
    }

    public function affectingStatement($query, $bindings = []): int
    {
        $statement = $this->getPreparedStatment($query, $bindings);
        $statement->execute();

        return $statement->rowCount();
    }

    public function select($query, $bindings = [])
    {
        $statement = $this->getPreparedStatment($query, $bindings);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function insert($query, $bindings = []): bool
    {
        return $this->statement($query, $bindings);
    }

    public function update($query, $bindings = []): int
    {
        return $this->affectingStatement($query, $bindings);
    }

    public function delete($query, $bindings = []): int
    {
        return $this->affectingStatement($query, $bindings);
    }

    public function disconnect(): void
    {
        $this->PDO = null;
    }

    public function query(): QueryBuilder
    {
        return new QueryBuilder($this);
    }

    public function table($table, $as = null): QueryBuilder
    {
        return $this->query()->from($table, $as);
    }
}
