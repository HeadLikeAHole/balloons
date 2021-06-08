<?php

function sendError($to, $data)
{
    header("Location: /$to?" . http_build_query($data));
    exit;
}
