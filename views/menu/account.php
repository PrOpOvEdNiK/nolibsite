<?php

/** @var $arResult */

?>
<? if ($arResult['MENU']): ?>
    <div class="account__small">
        <? if ($arResult['USER_NAME']): ?>
            <div class="account__username">
                <?= $arResult['USER_NAME'] ?>
            </div>
        <? endif; ?>

        <div class="account__menu">
            <? foreach ($arResult['MENU'] as $arItem): ?>
                <a class="button <?= $arItem['CLASS'] ?>"
                   href="<?= $arItem['LINK'] ?>"
                >
                    <?= $arItem['TITLE'] ?>
                </a>
            <? endforeach; ?>
        </div>
    </div>
<? endif; ?>

