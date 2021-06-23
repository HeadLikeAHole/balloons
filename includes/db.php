<?php

include __DIR__ . '/../config.php';
include 'errors.php';

try {
    $pdo = new PDO($dns, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    displayDbError();
}
