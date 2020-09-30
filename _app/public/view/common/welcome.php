<?php

/** @var $arResult */

use BS\Facades\Auth;

?>
<section class="container">
    <div class="row">
        <div class="welocme">
            <? if (Auth::check()): ?>
                <h2>Привет, <?= Auth::getUserFullName(); ?>!</h2>
            <? else: ?>
                <h2>Привет!</h2>
                <p>Авторизуйся или зарегистрируйся.</p>
            <? endif; ?>
        </div>
    </div>
</section>
