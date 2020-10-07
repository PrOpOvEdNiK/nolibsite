<?php

namespace BS\Components\Menu;


use BS\Components\Component;
use BS\Facades\Auth;

class Top extends Component
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
