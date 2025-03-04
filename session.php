<?php

session_start();

if (empty($_SESSION['flash'])) {
    $_SESSION['flash'] = [];
}

function flash(?string $msg = null): ?array
{
    if (is_null($msg)) {
        $msgs = $_SESSION['flash'];
        $_SESSION['flash'] = [];
        return $msgs;
    }
    $_SESSION['flash'][] = $msg;
    return null;
}
