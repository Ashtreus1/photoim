<?php

require_once __DIR__ . '/../core/Database.php';

class UserImageModel
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function create($user_id, $tag_id, $title, $description, $image_path){
		$query = $this->pdo->prepare('
			INSERT INTO users_images (user_id, tag_id, title, description, image_path) 
			VALUES (?, ?, ?, ?, ?)
		');
		$query->execute([$user_id, $tag_id, $title, $description, $image_path]);
	}


	public function getImageDetailsByPath($imagePath)
	{
		$query = $this->pdo->prepare('
			SELECT users_images.*, users.username
			FROM users_images
			JOIN users ON users.id = users_images.user_id
			WHERE users_images.image_path = ?
			LIMIT 1
		');
		$query->execute([$imagePath]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function getImageIdByPath($path)
	{
		$query = $this->pdo->prepare('SELECT id FROM users_images WHERE image_path = ? LIMIT 1');
		$query->execute([$path]);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result ? $result['id'] : null;
	}
}
