<?php

/** @var $arResult */

?>
<div class="auth__form">
    <div class="container">
        <div class="row">
            <h1>Регистрация</h1>
        </div>

        <form action="">
            <div class="registration__step show" id="registration-step-1">
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-last-name" type="text" name="LAST_NAME"
                               maxlength="50"
                        >
                        <label for="registration-last-name">Фамилия</label>
                    </div>
                    <div class="form__input">
                        <input id="registration-first-name" type="text" name="FIRST_NAME"
                               maxlength="50"
                        >
                        <label for="registration-first-name">Имя</label>
                    </div>
                    <div class="form__input">
                        <input id="registration-second-name" type="text" name="SECOND_NAME"
                               maxlength="50"
                        >
                        <label for="registration-second-name">Отчество</label>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-email" type="email" name="EMAIL">
                        <label for="registration-email">Email</label>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-birth-date" type="date" name="BIRTH_DATE">
                        <label for="registration-birth-date">День рождения</label>
                    </div>
                    <div class="form__input">
                        <select name="GENDER" id="registration-gender">
                            <option value="">---</option>
                            <option value="M">Мужской</option>
                            <option value="F">Женский</option>
                        </select>
                        <label for="registration-gender">Пол</label>
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-2">
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-avatar" type="file" name="AVATAR">
                        <label for="registration-avatar">Аватар</label>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-favorite-color" type="color" name="FAVORITE_COLOR">
                        <label for="registration-favorite-color">Любимый цвет</label>
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-3">
                <div class="form__row">
                    <div class="form__input">
                        <textarea id="registration-profile" name="PROFILE"></textarea>
                        <label for="registration-profile">Личные качества</label>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-skils-1" type="checkbox" name="SKILS[]" value="1">
                        <label for="registration-skils-1">Усидчивость</label>
                    </div>
                    <div class="form__input">
                        <input id="registration-skils-2" type="checkbox" name="SKILS[]" value="2">
                        <label for="registration-skils-2">Опрятность</label>
                    </div>
                    <div class="form__input">
                        <input id="registration-skils-3" type="checkbox" name="SKILS[]" value="3">
                        <label for="registration-skils-3">Самообучаемость</label>
                    </div>
                    <div class="form__input">
                        <input id="registration-skils-4" type="checkbox" name="SKILS[]" value="4">
                        <label for="registration-skils-4">Трудолюбие</label>
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-4">
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-gallery" type="file" name="GALLERY[]" multiple>
                        <label for="registration-gallery">Дополнительные фотографии</label>
                    </div>
                </div>
            </div>

            <div class="registration__step" id="registration-step-5">
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-password" type="password" name="PASSWORD">
                        <label for="registration-password">Пароль</label>
                    </div>
                <div class="form__row">
                    <div class="form__input">
                        <input id="registration-password2" type="password" name="PASSWORD2">
                        <label for="registration-password2">Пароль еще раз</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
