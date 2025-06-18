<?php

require_once __DIR__ . '/../core/Database.php';

class CommentModel {
	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function getAllComments($imageId){
		$query = $this->pdo->prepare('
			SELECT c.*, u.username 
			FROM comments c 
			JOIN users u ON c.user_id = u.id
			WHERE c.image_id = ?
			ORDER BY c.created_at DESC
		');
		$query->execute([$imageId]);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function createComment($userId, $imageId, $message){
		$query = $this->pdo->prepare('
			INSERT INTO comments (user_id, image_id, message)
			VALUES (?, ?, ?)
		');
		return $query->execute([$userId, $imageId, $message]);
	}

	public function getImageByPath($path){
		$query = $this->pdo->prepare('SELECT id FROM users_images WHERE image_path = ? LIMIT 1');
		$query->execute([$path]);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result ? $result['id'] : null;
	}
}
