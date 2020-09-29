<?php

/** @var $arResult */

?>
<nav>
    <? foreach ($arResult as $arItem): ?>
        <div>
            <a href="<?= $arItem['LINK'] ?>">
                <?= $arItem['TITLE'] ?>
            </a>
        </div>
    <? endforeach; ?>
</nav>
