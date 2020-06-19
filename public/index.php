<?php declare(strict_types=1);
if (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    exit('{"status":"ok"}');
}
?><!DOCTYPE html>
