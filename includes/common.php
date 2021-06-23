<?php

include 'db.php';
include 'classes/UserModel.php';
include 'fns.php';

session_start();

try {
    $user = (new UserModel)->getLoggedInUser();
} catch (PDOException $e) {
    displayDbError();
}
