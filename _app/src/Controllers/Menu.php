<?php

namespace BS\Controllers;


use BS\Facades\Auth;

class Menu extends Controller
{
    public function execute()
    {
        if (Auth::isAdmin()) {
            $this->arResult['MENU'][] = [
                'TITLE' => 'Админка',
                'LINK' => '/admin/',
            ];
        }

        $this->arResult['MENU'][] = [
            'TITLE' => 'Главная',
            'LINK' => '/',
        ];
    }
}
