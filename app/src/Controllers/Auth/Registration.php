<?php


namespace BS\Controllers\Auth;


use BS\Controllers\Controller;

class Registration extends Controller
{

    public function execute()
    {
        $this->arResult['SEO'] = [
            'h1'          => 'Регистрация',
            'title'       => 'Регистрация',
            'description' => 'Регистрация',
        ];
    }
}
