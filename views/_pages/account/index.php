<?php

/** @var $arResult */

use BS\Facades\Auth;

?>
<section class="container">
    <div class="row">
        <div class="welcome">
            <h2>Привет, <?= Auth::getUserFullName(); ?>!</h2>
        </div>
    </div>
</section>
