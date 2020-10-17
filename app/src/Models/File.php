<?php


namespace BS\Models;


use BS\Main\Validator;

class File extends Model
{

    public static function getTableName()
    {
        return 'files';
    }

    public static function getMap()
    {
        return [
            "ID"             => [
                "TYPE" => Validator::INT,
                "AUTO" => true
            ],
            "PATH"      => [
                "TYPE"       => Validator::STRING
            ],
            "NAME"      => [
                "TYPE"       => Validator::STRING
            ],
            "TYPE"      => [
                "TYPE"       => Validator::STRING
            ],
            "SIZE"         => [
                "TYPE"      => Validator::INT
            ],
        ];
    }
}
