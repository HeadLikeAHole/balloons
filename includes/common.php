<?php

include 'classes/UserModel.php';
include 'errors.php';

session_start();

$user = (new UserModel)->getLoggedInUser();
