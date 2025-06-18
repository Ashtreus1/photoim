<?php

require_once __DIR__ . '/../models/CommentModel.php';
require_once __DIR__ . '/../core/Database.php';

class CommentController {
	private $pdo;
	private $commentModel;

	public function __construct(){
		$this->pdo = new Database();
		$this->commentModel = new CommentModel($this->pdo->connection);
	}

	public function handleCreateComment(){
		$user_id = $_SESSION['user_id'] ?? null;
		$imagePath = $_GET['image'] ?? null;
		$comment = $_POST['comment'] ?? null;

		if ($user_id && $imagePath && $comment) {
			$imageId = $this->commentModel->getImageByPath($imagePath);
			if ($imageId) {
				$this->commentModel->createComment($user_id, $imageId, $comment);
			}
		}

		header('Location: ' . basePath('/view-page?success=true'));
		exit;
	}

	public function handleGetAllComment($imagePath){
		$imageId = $this->commentModel->getImageByPath($imagePath);
		if ($imageId) {
			return $this->commentModel->getAllComments($imageId);
		}

		return [];
	}
}
