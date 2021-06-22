<?php

include 'dbConnection.php';
include 'classes/UserModel.php';
include 'helperFunctions.php';

session_start();

try {
    $user = (new UserModel($pdo))->getLoggedInUser();
} catch (PDOException $e) {
    displayDbError();
}
