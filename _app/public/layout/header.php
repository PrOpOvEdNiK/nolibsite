<?php
global $pageTitle;
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>

    <title><?= $pageTitle ?> | Анкетирование</title>
    <meta name="description" content="Демонстрационный сайт">

    <link rel="stylesheet" href="<?= APP_ASSETS_PATH ?>/css/app.css<?= BS\App\Assets::getVersion() ?>">
</head>
<body class="app">
<header class="app__header">
    <div class="container">
        <div class="container__row">
            <div class="header__nav">
                <? callComponent('Menu', 'menu/top'); ?>
            </div>
            <div class="header__account">
                <? callComponent('AccountMenu', 'menu/top'); ?>
            </div>
        </div>
    </div>
</header>

<main class="app__main">
