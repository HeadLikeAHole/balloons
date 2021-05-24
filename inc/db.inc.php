<?php

$dns = 'mysql:host=localhost;dbname=balloons';
$user = 'root';
$password = '';

$pdo = new PDO($dns, $user, $password);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);