<?php

include 'fns.php';

session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// destroy cookies
setcookie('user_id', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');
setcookie('password', '', time() - 3600, '/');

session_start();
// without this function message isn't saved to session for some reason
session_regenerate_id();
sendMessage('', 'warning', 'Вы вышли из своего аккаунта.');
