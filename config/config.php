<?php
function getBasePathConfig()
{
    $path = '';
    $currentDir = dirname($_SERVER['PHP_SELF']);

    $depth = substr_count($currentDir, '/');
    for ($i = 1; $i < $depth; $i++) {
        $path .= '../';
    }

    return $path;
}
require getBasePathConfig() . 'functions/helpers.php';
require 'db_connect.php';
session_start();
