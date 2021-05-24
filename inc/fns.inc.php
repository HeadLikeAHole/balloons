<?php

require 'db.inc.php';

// find user in DB
function findUser($username)
{
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM `users` WHERE username=:username');
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function getLoggedInUser()
{
    if (isset($_SESSION['username'])) {
        $user = findUser($_SESSION['username']);
        if ($user && $user->password === $_SESSION['password']) return $user;
        return false;
    } elseif (isset($_COOKIE['username'])) {
        $user = findUser($_COOKIE['username']);
        if ($user && $user->password === $_COOKIE['password']) {
            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['password'] = $user->password;
            return $user;
        }
    }
    return false;
}

function getCategories()
{
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM `categories` ORDER BY `id` ASC');
    $query->execute();

    return $query->fetchAll();
}

function createProduct($user_id, $category_id, $image, $title, $description, $category)
{
    global $pdo;

    $query = $pdo->prepare("INSERT INTO `products` (`user_id`, `category_id`, `image`, `title`, `description`) VALUES ($user_id, $category_id, $image, $title, $description, $category)");
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);

    return $query->execute();
}