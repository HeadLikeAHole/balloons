<?php

include 'classes/UserModel.php';

session_start();

$user = (new UserModel)->getLoggedInUser();
