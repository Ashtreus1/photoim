<?php
session_start();

require_once BASE_PATH . '/controllers/UserController.php';
require_once BASE_PATH . '/controllers/TagController.php';
require_once BASE_PATH . '/controllers/UserImageController.php';
require_once BASE_PATH . '/controllers/CommentController.php';
require_once BASE_PATH . '/core/Auth.php';

$user = new UserController();
$userImage = new UserImageController();
$comment = new CommentController();
$tagController = new TagController();

global $render;

// Home Page (guest only)
$router->get('/', function () use ($render, $tagController) {
    redirectIfAuthenticated();

    $tags = $tagController->handleFetchTags();
    $render->view('home', [
        'title' => 'Photoim',
        'tags' => $tags
    ]);
});

// Register
$router->get('/register', function () use ($render) {
    redirectIfAuthenticated();
    $render->setLayout('layouts/auth');
    $render->view('auth/register', ['title' => 'Register Now']);
});
$router->post('/register', fn () => (new UserController())->handleRegister());

// Login
$router->get('/login', function () use ($render) {
    redirectIfAuthenticated();
    $render->setLayout('layouts/auth');
    $render->view('auth/login', ['title' => 'Login Now']);
});
$router->post('/login', fn () => (new UserController())->handleLogin());

// Logout
$router->get('/logout', fn () => (new UserController())->handleLogout());

// Feed Page
$router->get('/feed', function () use ($render, $userImage, $tagController) {
    requireAuth();

    $tags = $tagController->handleFetchTags();
    $images = $userImage->getAllImages();

    $render->setLayout('layouts/protected');
    $render->view('protected/feed', [
        'title' => 'Feed',
        'tags' => $tags,
        'images' => $images
    ]);
});

// Create Post
$router->get('/creation-post', function () use ($render, $tagController) {
    requireAuth();

    $tags = $tagController->handleFetchTags();
    $render->setLayout('layouts/protected');
    $render->view('protected/creation_post', [
        'title' => 'Create Post',
        'tags' => $tags
    ]);
});
$router->post('/creation-post', fn () => (new UserImageController())->handlePost());

// Profile
$router->get('/profile', function () use ($render) {
    requireAuth();

    $render->setLayout('layouts/protected');
    $render->view('protected/profile', [
        'title' => 'Profile'
    ]);
});

// View Page
$router->get('/view-page', function () use ($render, $userImage, $comment) {
    requireAuth();

    $imagePath = $_GET['image'] ?? null;
    if (!$imagePath) {
        header('Location: ' . basePath('/feed'));
        exit;
    }

    $imageDetails = $userImage->getImageDetails($imagePath);
    if (!$imageDetails) {
        header('Location: ' . basePath('/feed?error=ImageNotFound'));
        exit;
    }

    $comments = $comment->handleGetAllComment($imagePath);

    $render->setLayout('layouts/view');
    $render->view('protected/view-page', [
        'title' => 'View Image',
        'imagePath' => $imagePath,
        'imageDetails' => $imageDetails,
        'comments' => $comments
    ]);
});
$router->post('/view-page', fn () => (new CommentController())->handleCreateComment());
