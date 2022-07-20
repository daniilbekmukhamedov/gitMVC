<?php

ini_set('display_errors', 0);
error_reporting(0);

function debug ($val)
{
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
    exit;
}