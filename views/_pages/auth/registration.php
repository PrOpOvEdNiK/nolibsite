<?php

/** @var $arResult */

use BS\Facades\Auth;

$arFields = $arResult['POST']['fields'];
$arSave = $arResult['SAVE'];
?>
<div class="auth__form">
    <div class="container">
        <div class="row">
            <h1>Регистрация</h1>
        </div>

        <? if (!$arSave['SUCCESS'] && $arSave['ERRORS']): ?>
            <div class="form__errors">
                <?= showFormErrors($arSave['ERRORS']); ?>
            </div>
        <? endif; ?>

        <form class="form" enctype="multipart/form-data" method="post">
            <input type="hidden" name="csrf" value="<?= Auth::getCsrf() ?>">
            <input type="hidden" name="backurl" value="<?= ROUTE_ACCOUNT ?>">
            <input type="hidden" name="action" value="register">

            <div class="registration__step show" id="registration-step-1">
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-last-name">Фамилия</label>
                        <input id="registration-last-name" type="text" name="fields[LAST_NAME]"
                               maxlength="50" value="<?= $arFields['LAST_NAME'] ?>"
                        >
                    </div>
                    <div class="form__input">
                        <label for="registration-first-name">Имя</label>
                        <input id="registration-first-name" type="text" name="fields[FIRST_NAME]"
                               maxlength="50" value="<?= $arFields['FIRST_NAME'] ?>"
                        >
                    </div>
                    <div class="form__input">
                        <label for="registration-second-name">Отчество</label>
                        <input id="registration-second-name" type="text" name="fields[SECOND_NAME]"
                               maxlength="50" value="<?= $arFields['SECOND_NAME'] ?>"
                        >
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-email">Email</label>
                        <input id="registration-email" type="email" name="fields[EMAIL]"
                               maxlength="50" value="<?= $arFields['EMAIL'] ?>"
                        >
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-birth-date">День рождения</label>
                        <input id="registration-birth-date" type="date" name="fields[BIRTH_DATE]"
                               value="<?= $arFields['BIRTH_DATE'] ?>"
                        >
                    </div>
                    <div class="form__input">
                        <label for="registration-gender">Пол*</label>
                        <select name="fields[GENDER]" id="registration-gender">
                            <option value="">---</option>
                            <option value="M">Мужской</option>
                            <option value="F">Женский</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-2">
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-avatar">Аватар</label>
                        <input id="registration-avatar" type="file" name="AVATAR">
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-favorite-color">Любимый цвет</label>
                        <input id="registration-favorite-color" type="color" name="fields[FAVORITE_COLOR]"
                               value="<?= $arFields['FAVORITE_COLOR'] ?>"
                        >
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-3">
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-profile">Личные качества</label>
                        <textarea id="registration-profile"
                                  name="fields[PROFILE]"><?= $arFields['PROFILE'] ?></textarea>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-skils-1">Усидчивость</label>
                        <input id="registration-skils-1" type="checkbox" name="SKILS[]" value="1">
                    </div>
                    <div class="form__input">
                        <label for="registration-skils-2">Опрятность</label>
                        <input id="registration-skils-2" type="checkbox" name="SKILS[]" value="2">
                    </div>
                    <div class="form__input">
                        <label for="registration-skils-3">Самообучаемость</label>
                        <input id="registration-skils-3" type="checkbox" name="SKILS[]" value="3">
                    </div>
                    <div class="form__input">
                        <label for="registration-skils-4">Трудолюбие</label>
                        <input id="registration-skils-4" type="checkbox" name="SKILS[]" value="4">
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-4">
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-gallery">Дополнительные фотографии</label>
                        <input id="registration-gallery" type="file" name="GALLERY[]" multiple>
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-5">
                <div class="form__row">
                    <div class="form__input">
                        <label for="registration-password">Пароль</label>
                        <input id="registration-password" type="password" name="fields[PASSWORD]">
                    </div>
                    <div class="form__row">
                        <div class="form__input">
                            <label for="registration-password2">Пароль еще раз</label>
                            <input id="registration-password2" type="password" name="PASSWORD2">
                        </div>
                    </div>
                </div>

                <div class="form__actions">
                    <button type="submit">Зарегистрироваться</button>
                </div>
            </div>
        </form>
    </div>
</div>
