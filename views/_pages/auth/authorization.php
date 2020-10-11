<?php

/** @var $arResult */

use BS\Facades\Auth;

$arFields = $arResult['POST']['fields'];
$arSave = $arResult['SAVE'];
?>
<div class="auth__form">
    <div class="container">
        <div class="row">
            <h1>Авторизация</h1>
        </div>

        <? if (!$arSave['SUCCESS'] && $arSave['ERRORS']): ?>
            <div class="form__errors">
                <?= showFormErrors($arSave['ERRORS']); ?>
            </div>
        <? endif; ?>

        <form class="form" enctype="multipart/form-data" method="post">
            <input type="hidden" name="csrf" value="<?= Auth::getCsrf() ?>">
            <input type="hidden" name="backurl" value="<?= ROUTE_ACCOUNT ?>">
            <input type="hidden" name="action" value="login">

            <div class="form__row">
                <div class="form__input">
                    <label for="login-email">Email</label>
                    <input id="login-email" type="email" name="EMAIL" value="<?= $arFields['EMAIL'] ?>">
                </div>
                <div class="form__row">
                    <div class="form__input">
                        <label for="login-password">Пароль</label>
                        <input id="login-password" type="password" name="PASSWORD">
                    </div>
                </div>
            </div>

            <div class="form__actions">
                <button type="submit">Войти</button>
            </div>
        </form>
    </div>
</div>
