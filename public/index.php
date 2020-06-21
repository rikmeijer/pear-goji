<?php declare(strict_types=1);
if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    exit('{"status":"ok"}');
}
?><!doctype html>
<html lang="en">
<head>
    <title>𓀁</title>
</head>
</html>
