<?php


namespace BS\Models;


use BS\App\Validator;
use BS\Facades\DB;

abstract class Model
{
    abstract public static function getTableName();

    abstract public static function getMap();

    public static function create($arFields): bool
    {
        static::validateFields($arFields);

        $table = static::getTableName();
        $sBindings = static::prepareInsertBindings($arFields);
        return DB::insert("INSERT INTO {$table} {$sBindings};", $arFields);
    }

    public static function read($arFilter = [], $arSelect = ['*'], $arOrder = [], $arLimit = []): array
    {
        $table = static::getTableName();
        $sSelect = implode(', ', $arSelect);

        [$sFilter, $arValuesMap] = static::prepareSelectBindings($arFilter);

        $sOrder = self::prepareOrderClause($arOrder);
        $sLimit = self::prepareLimitClause($arLimit);

        return DB::select(
            "SELECT {$sSelect} FROM {$table} {$sFilter} {$sOrder} {$sLimit};",
            $arValuesMap
        );
    }

    public static function update($arFilter, $arFields): int
    {
        static::validateFields($arFields);

        $table = static::getTableName();

        [$sFilter, $arValuesMapFilter] = static::prepareSelectBindings($arFilter);
        [$sUpdate, $arValuesMapUpdate] = static::prepareUpdateBindings($arFields);

        return DB::update(
            "UPDATE {$table} {$sUpdate} {$sFilter}",
            $arValuesMapFilter + $arValuesMapUpdate
        );
    }

    public static function delete($arFilter): int
    {
        $table = static::getTableName();

        [$sFilter, $arValuesMap] = static::prepareSelectBindings($arFilter);

        return DB::delete(
            "DELETE FROM {$table} {$sFilter}",
            $arValuesMap
        );
    }

    protected static function prepareInsertBindings($arFields): string
    {
        $arKeys = $arValues = [];

        $arMap = static::getMap();
        foreach ($arMap as $kColumn => $arColumn) {
            if ($arColumn['AUTO'] || !in_array($kColumn, array_keys($arFields))) {
                continue;
            }

            $arKeys[] = $kColumn;
            $arValues[] = ":{$kColumn}";
        }

        $sKeys = implode(', ', $arKeys);
        $sValues = implode(', ', $arValues);

        return "({$sKeys}) VALUES ({$sValues})";
    }

    protected static function prepareSelectBindings($arFilter): array
    {
        $arFilterParts = [];
        $arValuesMap = [];
        foreach ($arFilter as $arItem) {
            [$column, $sign, $value] = $arItem;
            $arValuesMap[$column] = $value;

            $arFilterParts[] = "{$column} {$sign} :{$column}";
        }

        $sFilterParts = implode(" AND ", $arFilterParts);
        $sFilter = $sFilterParts ? "WHERE {$sFilterParts}" : "";

        return [$sFilter, $arValuesMap];
    }

    protected static function prepareUpdateBindings($arFields): array
    {
        $arSetParts = $arValuesMap = [];
        foreach ($arFields as $kField => $vField) {
            $alias = "U_{$kField}";
            $arSetParts[] = "{$kField} = :{$alias}";

            $arValuesMap[$alias] = $vField;
        }
        $sSet = implode(', ', $arSetParts);

        $sUpdate = "SET {$sSet}";

        return [$sUpdate, $arValuesMap];
    }

    protected static function prepareLimitClause($arLimit): string
    {
        $limit = $arLimit[0] ?? DB_FALLBACK_LIMIT;
        $offset = $arLimit[1] ?? 0;

        return "LIMIT {$offset},{$limit}";
    }

    protected static function prepareOrderClause($arOrder): string
    {
        $sOrder = implode(', ', $arOrder);

        if (!$sOrder) {
            $sOrder = "ID DESC";
        }
        return "ORDER BY {$sOrder}";
    }

    public static function validateFields(&$arFields): void
    {
        $arErrors = [];

        $arMap = static::getMap();
        foreach ($arFields as $kField => &$vField) {
            $validateFunction = $arMap[$kField]['TYPE'];
            $vField = Validator::$validateFunction($arMap[$kField], $vField, $arErrors[$kField]);
        }

        $arErrors = array_filter($arErrors);
        if ($arErrors) {
            throw new ValidateException($arErrors);
        }
    }
}
