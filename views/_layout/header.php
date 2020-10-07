<?php
/**
 * @var $arResult
 */

use BS\Facades\Config;
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>

    <title><?= $arResult['SEO']['title'] ?> | <?= Config::getAppName(); ?></title>
    <meta name="description" content="<?= $arResult['SEO']['description'] ?>. Демонстрационный сайт">

    <link rel="stylesheet" href="<?= PATH_PUBLIC_ASSETS ?>/css/app.css<?= BS\Main\Assets::getVersion() ?>">
</head>
<body class="app">
<header class="app__header">
    <section class="container">
        <div class="row jcsb">
            <div class="row">
                <div class="header__title">
                    <a href="/" class="h1"><?= Config::getAppName(); ?>. <?= $arResult['SEO']['h1'] ?></a>
                </div>

                <div class="header__nav">
                    <? includeComponent('Menu\\Top', 'menu/top'); ?>
                </div>
            </div>

            <div class="header__account">
                <? includeComponent('Menu\\AccountHeader', 'menu/account'); ?>
            </div>
        </div>
    </section>
</header>

<main class="app__main">
