<?php

if (isset($_POST['login-submit'])) {
    include 'classes/UserModel.php';

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        header('Location: /login?error=1');
        exit;
    }

    if (empty($password)) {
        header("Location: /login?error=2&username=$username");
        exit;
    }

    try {
        $user = (new UserModel)->get('username', $username);;

        if (!$user) {
            header("Location: /login?error=3&username=$username");
            exit;
        }

        if (!password_verify($password, $user->password)) {
            header("Location: /login?error=4&username=$username");
            exit;
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

        header('Location: /?message=0');
    } catch (PDOException $e) {
        header('Location: /login?error=0');
        exit;
    }
} else {
    header('Location: /');
    exit;
}
