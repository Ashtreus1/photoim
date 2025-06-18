<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/UserImageModel.php';


class UserImageController
{
	private $pdo;
	private $userImageModel;

	public function __construct()
	{
		$this->pdo = new Database();
		$this->userImageModel = new UserImageModel($this->pdo->connection);
	}

	public function handlePost()
	{
		$user_id = $_SESSION['user_id'];
		$tag_id = $_POST['tag_id'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$image_tmp_path = $_FILES['image']['tmp_name'];

		if (isset($_FILES['image']['error']) && $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
			header('Location: ' . basePath('/creation-post?error=Image upload error'));
			exit;
		}

		if (!$user_id || !$tag_id || !$title || !$image_tmp_path) {
			header('Location: ' . basePath('/creation-post?error=Missing-required-fields'));
			exit;
		}

		$uploadDir = 'uploads/';
		$filename = basename($_FILES['image']['name']);
		$uploadPath = $uploadDir . $filename;

		if (!move_uploaded_file($image_tmp_path, $uploadPath)) {
			header('Location: ' . basePath('/creation-post?error=Failed-to-upload-image'));
			exit;
		}

		$this->userImageModel->create($user_id, $tag_id, $title, $description, $uploadPath);

		header('Location: ' . basePath('/feed?post_created=true'));
		exit;
	}

	public function getAllImages()
	{
		return $this->userImageModel->getAllImages();
	}
	public function handleGetAllImages(){
		return $this->userImageModel->getAllImages();
	}

	public function getImageDetails($imagePath)
	{
		return $this->userImageModel->getImageDetailsByPath($imagePath);
	}
	public function handleGetImagesByTag($tagName) {
		return $this->userImageModel->getImagesByTag($tagName);
	}
}
