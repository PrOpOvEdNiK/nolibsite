<?php

/** @var $arResult */

?>
<nav>
    <? foreach ($arResult['MENU'] as $arItem): ?>
        <div>
            <a href="<?= $arItem['LINK'] ?>">
                <?= $arItem['TITLE'] ?>
            </a>
        </div>
    <? endforeach; ?>
</nav>
