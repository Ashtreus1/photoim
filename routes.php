<?php

require_once BASE_PATH . '/controllers/UserController.php';
require_once BASE_PATH . '/controllers/TagController.php';
require_once BASE_PATH . '/core/Auth.php';
require_once BASE_PATH . '/controllers/UserImageController.php';

$user = new UserController();
$auth = new Auth();
$userImage = new UserImageController();

global $render;

$router->get('/', function() use($render, $auth){
    $auth->redirectIfAuthenticated();

    $tagController = new TagController();
    $tags = $tagController->handleFetchTags();

    $render->view('home', [
        'title' => 'Photoim',
        'tags' => $tags
    ]);
});

$router->get('/register', function() use($render, $auth){
    $auth->redirectIfAuthenticated();
    $render->setLayout('layouts/auth');
    $render->view('auth/register', ['title' => 'Register Now']);
});

$router->get('/login', function() use($render, $auth){
    $auth->redirectIfAuthenticated();
    $render->setLayout('layouts/auth');
    $render->view('auth/login', ['title' => 'Login Now']);
}); 

$router->get('/register', function () use ($render, $auth) {
    $auth->redirectIfAuthenticated();
	$render->setLayout('layouts/auth');
	$render->view('auth/register', ['title' => 'Register Now']);
});


$router->post('/register', fn() => $user->handleRegister());
$router->post('/login', fn() => $user->handleLogin());
$router->post('/creation-post', fn() => $userImage->handlePost());


$router->get('/feed', function() use($render, $auth, $user, $userImage){
    $auth->requireAuth();

    $tagController = new TagController();
    $tags = $tagController->handleFetchTags();

    $userEmail = $auth->userId();
    $userData = $user->handleFetchUsernameAvatar($userEmail);
    // $images = $userImage->getAllImages();

    // Debug output
    if (empty($images)) {
        error_log("No images returned from getAllImages()");
    } else {
        error_log("Found " . count($images) . " images");
    }

    $render->setLayout('layouts/protected');
    $render->view('protected/feed', [
        'title' => 'Feed',
        'tags' => $tags,
        'userData' => $userData,
        // 'images' => $images
    ]);
});

$router->get('/profile', function() use($render, $auth, $user){
    $auth->requireAuth();

    $userEmail = $auth->userId();
    $userData = $user->handleFetchUsernameAvatar($userEmail);

    $render->setLayout('layouts/protected');
    $render->view('protected/profile', [
        'title' => 'Profile',
        'userData' => $userData
    ]);
});


$router->get('/logout', function() use($auth){
    $auth->logout();
    header('Location: ' . basePath('/login'));
    exit;
});



$router->get('/creation-post', function() use($render, $auth, $user){
    $auth->requireAuth();

    $tagController = new TagController();
    $tags = $tagController->handleFetchTags();

    $userEmail = $auth->userId();
    $userData = $user->handleFetchUsernameAvatar($userEmail);       

    $render->setLayout('layouts/protected');
    $render->view('protected/creation_post', [
        'title' => 'Create Post',
        'tags' => $tags,
        'userData' => $userData
    ]);
});

$router->get('/view-page', function() use($render, $auth, $user, $userImage){
    $auth->requireAuth();
    
    $imagePath = $_GET['image'] ?? null;
    if (!$imagePath) {
        header('Location: ' . basePath('/feed'));
        exit;
    }    $userEmail = $auth->userId();
    $userData = $user->handleFetchUsernameAvatar($userEmail);


    $render->setLayout('layouts/view');
    $render->view('protected/view-page', [
        'title' => 'View Image',
        'imagePath' => $imagePath,
        'userData' => $userData
    ]);
});