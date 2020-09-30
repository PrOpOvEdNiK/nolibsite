<?php

namespace BS\Controllers\Menu;


use BS\Controllers\Controller;
use BS\Facades\Auth;

class Top extends Controller
{
    public function execute()
    {
        if (Auth::check()) {
            $this->arResult['MENU'][] = [
                'TITLE' => 'Главная',
                'LINK' => '/',
            ];
        }

        if (Auth::isAdmin()) {
            $this->arResult['MENU'][] = [
                'TITLE' => 'Админка',
                'LINK' => '/admin/',
            ];
        }
    }
}
