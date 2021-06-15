<?php

include 'classes/UserModel.php';
include 'errors.php';
include 'helperFunctions.php';

session_start();

try {
    $user = (new UserModel)->getLoggedInUser();
} catch (PDOException $e) {
    $data['error'] = 'dberror';
    sendError('/', $data);
}
