<?php
class Auth {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function userId() {
        return $_SESSION['user_id']['email'] ?? null;
    }

    public function check() {
        return isset($_SESSION['user_id']);
    }

    public function login($user) {
        $_SESSION['user_id'] = [
            'email' => $user['email'],
            'username' => $user['username'],
            'user_id' -> $user['id']
        ];
    }

    public function logout() {
        unset($_SESSION['user_id']);
        session_destroy();
    }

    public function requireAuth() {
        if (!$this->check()) {
            header('Location: ' . basePath('/login'));
            exit;
        }
    }

    public function redirectIfAuthenticated() {
        if ($this->check()) {
            header('Location: ' . basePath('/feed'));
            exit;
        }
    }
}
