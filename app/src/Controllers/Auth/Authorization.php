<?php


namespace BS\Controllers\Auth;


use BS\Controllers\Controller;

class Authorization extends Controller
{

    public function execute()
    {
        $this->arResult['SEO'] = [
            'h1'          => 'Авторизация',
            'title'       => 'Авторизация',
            'description' => 'Авторизация',
        ];
    }
}
