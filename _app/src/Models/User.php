<?php


namespace BS\Models;


class User extends Model
{
    public static function getTableName()
    {
        return 'users';
    }

    public static function getMap()
    {
        return [
            "ID"             => [
                "TYPE" => "bigint",
                "AUTO" => true
            ],
            "LAST_NAME"      => [
                "TYPE" => "varchar"
            ],
            "FIRST_NAME"     => [
                "TYPE" => "varchar"
            ],
            "SECOND_NAME"    => [
                "TYPE" => "varchar"
            ],
            "BIRTH_DATE"     => [
                "TYPE" => "date"
            ],
            "GENDER"         => [
                "TYPE" => "char"
            ],
            "FAVORITE_COLOR" => [
                "TYPE" => "char"
            ],
            "PROFILE"        => [
                "TYPE" => "text"
            ],
            "SKILS"          => [
                "TYPE" => "text"
            ],
            "AVATAR"         => [
                "TYPE" => "bigint"
            ],
            "GALLERY"        => [
                "TYPE" => "text"
            ],
        ];
    }
}
