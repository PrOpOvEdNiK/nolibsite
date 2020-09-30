<?php

/** @var $arResult */

?>
<? if ($arResult['MENU']): ?>
    <nav>
        <? foreach ($arResult['MENU'] as $arItem): ?>
            <div>
                <a href="<?= $arItem['LINK'] ?>">
                    <?= $arItem['TITLE'] ?>
                </a>
            </div>
        <? endforeach; ?>
    </nav>
<? endif; ?>

