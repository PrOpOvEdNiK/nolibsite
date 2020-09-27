<?php


namespace BS\Models;


use BS\Facades\DB;

abstract class Model
{
    abstract public static function getTableName();

    abstract public static function getMap();

    public static function create($arFields)
    {
        $table = static::getTableName();
        $sBindings = static::prepareInsertBindings($arFields);
        return DB::insert("INSERT INTO {$table} {$sBindings};", $arFields);
    }

    public static function read($arFilter = [], $arSelect = ['*'], $arOrder = [], $arLimit = [])
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

    public static function update($arFilter, $arFields)
    {
        $table = static::getTableName();

        [$sFilter, $arValuesMapFilter] = static::prepareSelectBindings($arFilter);
        [$sUpdate, $arValuesMapUpdate] = static::prepareUpdateBindings($arFields);

        return DB::update(
            "UPDATE {$table} {$sUpdate} {$sFilter}",
            $arValuesMapFilter + $arValuesMapUpdate
        );
    }

    public static function delete($arFilter)
    {
        $table = static::getTableName();

        [$sFilter, $arValuesMap] = static::prepareSelectBindings($arFilter);

        return DB::delete(
            "DELETE FROM {$table} {$sFilter}",
            $arValuesMap
        );
    }

    protected static function prepareInsertBindings($arFields)
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

    protected static function prepareSelectBindings($arFilter)
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

    protected static function prepareUpdateBindings($arFields)
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

    protected static function prepareLimitClause($arLimit)
    {
        $limit = $arLimit[0] ?? DB_FALLBACK_LIMIT;
        $offset = $arLimit[1] ?? 0;

        return "LIMIT {$offset},{$limit}";
    }

    protected static function prepareOrderClause($arOrder)
    {
        $sOrder = implode(', ', $arOrder);

        if (!$sOrder) {
            $sOrder = "ID DESC";
        }
        return "ORDER BY {$sOrder}";
    }
}
