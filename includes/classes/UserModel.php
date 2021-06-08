<?php

include_once 'Model.php';

class UserModel extends Model
{
    protected $tableName = 'users';

    function getLoggedInUser()
    {
        if (isset($_SESSION['username'])) {
            $user = $this->get('username', $_SESSION['username']);
            if ($user && $user->password === $_SESSION['password']) return $user;
            return false;
        } elseif (isset($_COOKIE['username'])) {
            $user = $this->get('username', $_COOKIE['username']);
            if ($user && $user->password === $_COOKIE['password']) {
                $_SESSION['username'] = $_COOKIE['username'];
                $_SESSION['password'] = $user->password;
                return $user;
            }
        }
        return false;
    }
}