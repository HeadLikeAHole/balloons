<?php

if (isset($_POST['product-submit'])) {
    require 'fns.inc.php';

    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_SPECIAL_CHARS);


    if (empty($username)) {
        header('Location: /login?error=1');
        exit;
    }

    if (empty($password)) {
        header("Location: /login?error=2&username=$username");
        exit;
    }

    try {
        $user = findUser($username);

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

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $user->password;

        $expiration = strtotime('+3 months');;

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
