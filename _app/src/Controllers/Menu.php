<?php

namespace BS\Controllers;


class Menu extends Controller
{
    public function execute()
    {
        $this->arResult = [
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
