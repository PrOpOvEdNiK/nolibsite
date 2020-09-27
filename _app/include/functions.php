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
