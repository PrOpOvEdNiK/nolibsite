<?php


namespace BS\Controllers\Account;


use BS\Controllers\Controller;

class Index extends Controller
{
    public function execute()
    {
        $this->arResult['SEO'] = [
            'h1'          => 'Личный кабинет',
            'title'       => 'Личный кабинет',
            'description' => 'Личный кабинет',
        ];
    }
}
