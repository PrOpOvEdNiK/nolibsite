<?php

namespace BS\Components\Menu;


use BS\Components\Component;
use BS\Facades\Auth;

class AccountHeader extends Component
{
    public function execute()
    {
        if (Auth::check()) {
            $this->arResult['USER_NAME'] = Auth::getUserFullName();
            $this->arResult['MENU'] = [
                [
                    'TITLE' => 'Мой профиль',
                    'LINK'  => '/account/',
                ],
                [
                    'TITLE' => 'Выход',
                    'LINK'  => '/auth/logout/',
                ],
            ];
        } else {
            $this->arResult['MENU'] = [
                [
                    'TITLE' => 'Регистрация',
                    'LINK'  => '/auth/register/',
                ],
                [
                    'TITLE' => 'Авторизация',
                    'LINK'  => '/auth/',
                ],
            ];
        }
    }
}
