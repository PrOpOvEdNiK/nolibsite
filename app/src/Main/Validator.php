<?php


namespace BS\Main;


use DateTime;

use function serialize;

class Validator
{
    public const INT = 'int';
    public const STRING = 'string';
    public const DATE = 'date';
    public const SERIALIZE = 'serialize';
    public const EMAIL = 'email';

    public static function int(array $arRules, $value, &$arErrors): int
    {
        $int = filter_var(trim($value), FILTER_VALIDATE_INT);

        if (!$int) {
            $arErrors[] = "Значение должно быть числом";
        }

        if ($arRules['MAX_RANGE'] && ($int > $arRules['MAX_RANGE'])) {
            $arErrors[] = "Значение должно быть меньше {$arRules['MAX_RANGE']}";
        }

        if ($arRules['MIN_RANGE'] && ($int < $arRules['MIN_RANGE'])) {
            $arErrors[] = "Значение должно быть больше {$arRules['MIN_RANGE']}";
        }

        return $int;
    }

    public static function string(array $arRules, $value, &$arErrors): string
    {
        $string = filter_var(trim($value), FILTER_SANITIZE_STRING);

        if ($arRules['MAX_LENGTH'] && (mb_strlen($string) > $arRules['MAX_LENGTH'])) {
            $plurarSymbols = wordPlural($arRules['MAX_LENGTH'], ['символа', 'символов', 'символов']);
            $arErrors[] = "Значение должно быть короче {$arRules['MAX_RANGE']} {$plurarSymbols}";
        }

        if ($arRules['MIN_LENGTH'] && (mb_strlen($string) < $arRules['MIN_LENGTH'])) {
            $plurarSymbols = wordPlural($arRules['MIN_LENGTH'], ['символа', 'символов', 'символов']);
            $arErrors[] = "Значение должно быть длиннее {$arRules['MIN_LENGTH']} {$plurarSymbols}";
        }

        if ($arRules['EQUALS'] && (mb_strlen($string) !== $arRules['EQUALS'])) {
            $plurarSymbols = wordPlural($arRules['EQUALS'], ['символа', 'символов', 'символов']);
            $arErrors[] = "Значение должно состоять из {$arRules['EQUALS']} {$plurarSymbols}";
        }

        return $string;
    }

    public static function date(array $arRules, $value, &$arErrors):string
    {
        $format = $arRules['FORMAT'];
        $dateReference = DateTime::createFromFormat($format, $value);

        if (!$dateReference || $dateReference->format($format) !== $value) {
            $arErrors[] = "Некорректный формат даты";
        }

        return $value;
    }

    public static function serialize(array $arRules, $value, &$arErrors):string
    {
        if (!is_array($value)) {
            $arErrors[] = "Значние должно быть массивом";
        }

        return serialize($value);
    }

    public static function email(array $arRules, $value, &$arErrors):string
    {
        $email = filter_var(trim($value), FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $arErrors[] = "Некорректный email";
        }

        return $email;
    }
}
