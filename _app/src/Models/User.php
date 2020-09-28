<?php


namespace BS\Models;


use BS\App\Validator;

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
                "TYPE" => Validator::INT,
                "AUTO" => true
            ],
            "LAST_NAME"      => [
                "TYPE"       => Validator::STRING,
                "MIN_LENGTH" => 2,
                "MAX_LENGTH" => 50
            ],
            "FIRST_NAME"     => [
                "TYPE"       => Validator::STRING,
                "MIN_LENGTH" => 2,
                "MAX_LENGTH" => 50
            ],
            "SECOND_NAME"    => [
                "TYPE"       => Validator::STRING,
                "MIN_LENGTH" => 2,
                "MAX_LENGTH" => 50
            ],
            "BIRTH_DATE"     => [
                "TYPE"   => Validator::DATE,
                "FORMAT" => "Y-m-d"
            ],
            "GENDER"         => [
                "TYPE"   => Validator::STRING,
                "EQUALS" => 1
            ],
            "FAVORITE_COLOR" => [
                "TYPE"   => Validator::STRING,
                "EQUALS" => 7
            ],
            "PROFILE"        => [
                "TYPE"       => Validator::STRING,
                "MAX_LENGTH" => 1000
            ],
            "SKILS"          => [
                "TYPE" => Validator::SERIALIZE,
            ],
            "AVATAR"         => [
                "TYPE"      => Validator::INT,
                "MAX_RANGE" => 32
            ],
            "GALLERY"        => [
                "TYPE" => Validator::SERIALIZE,
            ],
            "PASSWORD"       => [
                "TYPE"       => Validator::STRING,
                "MAX_LENGTH" => 50
            ],
            "HASH"           => [
                "TYPE"       => Validator::STRING,
                "MAX_LENGTH" => 50
            ],
        ];
    }
}
