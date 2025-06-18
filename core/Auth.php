<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireAuth(): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . basePath('/login'));
        exit;
    }
}

function redirectIfAuthenticated(): void
{
    if (isset($_SESSION['user'])) {
        header('Location: ' . basePath('/feed'));
        exit;
    }
}
