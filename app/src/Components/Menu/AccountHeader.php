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
                    'CLASS' => 'button--green',
                ]
            ];
        } else {
            $this->arResult['MENU'] = [
                [
                    'TITLE' => 'Регистрация',
                    'LINK'  => '/auth/register/',
                    'CLASS' => 'button--transparent',
                ],
                [
                    'TITLE' => 'Авторизация',
                    'LINK'  => '/auth/',
                    'CLASS' => 'button--green',
                ],
            ];
        }
    }
}
