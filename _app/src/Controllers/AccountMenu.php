<?php

namespace BS\Controllers;


use BS\Facades\Auth;

class AccountMenu extends Controller
{
    public function execute()
    {
        if (Auth::check()) {
            $this->arResult['USER_NAME'] = Auth::getUserFullName();
            $this->arResult['MENU'] = [
                [
                    'TITLE' => 'Мой профиль',
                    'LINK' => '/account/',
                ]
            ];
        } else {
            $this->arResult['MENU'] = [
                [
                    'TITLE' => 'Регистрация',
                    'LINK' => '/auth/register/',
                ],
                [
                    'TITLE' => 'Авторизация',
                    'LINK' => '/auth/',
                ],
            ];
        }
    }
}
