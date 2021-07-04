<?php

function sendError($to, $data)
{
    header("Location: /$to?" . http_build_query($data));
    exit;
}

function sendMessage($to, $type, $message)
{
    if (!isset($_SESSION['messages'])) $_SESSION['messages'] = [];
    $_SESSION['messages'][] = ['type' => $type, 'text' => $message];
    header("Location: /$to");
    exit;
}

function getMessages()
{
    if (isset($_SESSION['messages'])) {
        $messages = $_SESSION['messages'];
        unset($_SESSION['messages']);
        return $messages;
    }

    return [];
}