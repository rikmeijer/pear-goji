<?php /** @noinspection GlobalVariableUsageInspection */ declare(strict_types=1);
if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    exit('{"status":"ok"}');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ?><!doctype html>
<html lang="en">
<head>
    <title>𓀁</title>
</head>
<body>
<h1>Answers</h1>
</body>
</html>
    <?php
    exit;
}
?><!doctype html>
<html lang="en">
<head>
    <title>𓀁</title>
</head>
<body>
<h1>𓀁</h1>
<form action="/answers" method="post">
    <label for="query"><input type="text" id="query" placeholder="Stel een vraag"></label>
</form>
</body>
</html>
