<?php

include 'classes/UserModel.php';
include 'errors.php';

session_start();

try {
    $user = (new UserModel)->getLoggedInUser();
} catch (PDOException $e) {
    displayDbError();
}
