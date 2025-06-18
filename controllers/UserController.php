<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/Database.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $pdo = new Database();
        $this->userModel = new UserModel($pdo->connection);
    }

    public function handleLogin(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username'],
                'avatar_path' => $user['avatar_path'] ?? 'assets/images/user/avatar1.png'
            ];

            header('Location: ' . basePath('/feed'));
            exit;
        }

        header('Location: ' . basePath('/login?login_error=true'));
        exit;
    }

    public function handleLogout(): void
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: ' . basePath('/login'));
        exit;
    }

    public function handleRegister(): void
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($password !== $confirmPassword) {
            header('Location: ' . basePath('/register?error_password=Password did not match'));
            exit;
        }

        if ($this->userModel->findByEmail($email)) {
            header('Location: ' . basePath('/register?error_email=true'));
            exit;
        }

        if ($this->userModel->findByUsername($username)) {
            header('Location: ' . basePath('/register?error_username=true'));
            exit;
        }

        $this->userModel->create($username, $email, $password);

        header('Location: ' . basePath('/login?registered_success=true'));
        exit;
    }

    public function handleFetchUsernameAvatar(int $userId): ?array
    {
        return $this->userModel->fetchUsernameAvatar($userId);
    }
}
