<?php
function sanitize($input)
{
    return htmlspecialchars(strip_tags($input));
}
function getBasePath()
{
    $path = '';
    $currentDir = dirname($_SERVER['PHP_SELF']);

    $depth = substr_count($currentDir, '/');
    for ($i = 1; $i < $depth; $i++) {
        $path .= '../';
    }

    return $path;
}
