<?php


namespace BS\App;


class Menu
{
    public static function get()
    {
        return [
            [
                'TITLE' => 'Главная',
                'LINK' => '/',
            ],
            [
                'TITLE' => 'Новости',
                'LINK' => '/news/',
            ],
        ];
    }
}
