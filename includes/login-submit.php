<?php

include 'classes/UserModel.php';
include 'helperFunctions.php';

if (isset($_POST['login-submit'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $data = [];
    $data['username'] = $username;

    if (empty($username)) {
        $data['error'] = 'username-empty';
        sendError('login', $data);
    }

    if (empty($password)) {
        $data['error'] = 'password-empty';
        sendError('login', $data);
    }

    try {
        $user = (new UserModel)->get('username', $username);;

        if (!$user) {
            $data['error'] = 'username-wrong';
            sendError('login', $data);
        }

        if (!password_verify($password, $user->password)) {
            $data['error'] = 'password-wrong';
            sendError('login', $data);
        }

        session_start();
        session_regenerate_id();

        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $user->password;

        $expiration = strtotime('+3 months');;

        setcookie('user_id', $user->id, $expiration, '/');
        setcookie('username', $username, $expiration, '/');
        setcookie('password', $user->password, $expiration, '/');

        sendMessage('', 'success', 'Вы вошли в свой аккаунт.');
    } catch (PDOException $e) {
        displayDbError();
    }
} else {
    header('Location: /403');
}
