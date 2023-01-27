<?php

// todo Написать шапку сайта: html, head, body, меню, подключение css
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
    <link rel = "stylesheet" type="text/css" href="../www/static/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<title>Study project</title>
</head>
<div class="menu">
    <form action='' method='GET'>
        <input type="hidden" name = "page" value = "form">
        <input class=button_log1 type='submit' value='Форма'>
    </form>
    <form action='' method='GET'>
        <input type="hidden" name = "page" value = "list">
        <input class=button_log1 type='submit' value='Список'>
    </form>
</div>
<body>
<div class = "form">