<?php

function s($var) {
    $backTrace = debug_backtrace();
    $backTraceFile = $backTrace[0]['file'];
    $backTraceLine = $backTrace[0]['line'];

    ob_start();
    var_dump($var);
    $varExport = ob_get_clean();

    echo <<<DUMP
<div style="border: 1px solid black;padding: 30px;width: fit-content;">
<pre>{$backTraceFile} on line {$backTraceLine}</pre>
<pre>{$varExport}</pre>
</div>
DUMP;
}

/**
 * @param int|string $count
 * @param array $arWords array("день", "дня", "дней")
 * @return string
 */
function wordPlural($count, array $arWords)
{
    $value = intval($count);

    if ($value % 10 === 1 && ($value < 10 || $value > 20)) {
        return $arWords[0];
    }
    if (($value % 10 === 2 || $value % 10 === 3 || $value % 10 === 4) && ($value < 10 || $value > 20)) {
        return $arWords[1];
    }
    return $arWords[2];
}

function includeComponent($component, $view, $arParams = [])
{
    $fullController = "\\BS\\Components\\{$component}";
    if (class_exists($fullController)) {
        new $fullController($view, $arParams);
    } else {
        showError("Контроллер '{$fullController}' не найден");
    }
}

function showError($text = 'Ошибка') {
    echo <<<HTML
<div class="app__error">{$text}</div>
HTML;
}
