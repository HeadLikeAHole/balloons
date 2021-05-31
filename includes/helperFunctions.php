<?php

function sendError($to, $error)
{
    header("Location: /$to?error=$error");
    exit;
}
