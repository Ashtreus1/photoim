<?php

require_once __DIR__ . '/../core/Database.php';

class UserImageModel
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function create($user_id, $tag_id, $title, $description, $image_path)
	{
		$query = $this->pdo->prepare('INSERT INTO users_images (user_id, tag_id, title, description, image_path) VALUES (?, ?, ?, ?, ?)');
		$query->execute([$user_id, $tag_id, $title, $description, $image_path]);
	}
	public function getImageDetails($image_path)
	{
		$query = $this->pdo->prepare('
			SELECT ui.*, u.username, u.avatar_path 
			FROM users_images ui
			JOIN users u ON ui.user_id = u.id
			WHERE ui.image_path LIKE ?
		');
		$query->execute(['%' . basename($image_path)]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	public function getAllImages()
	{
		$sql = "SELECT * FROM users_images ORDER BY id DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getImagesByTag($tagName) {
		$sql = "SELECT ui.* FROM users_images ui JOIN tags t ON ui.tag_id = t.id WHERE t.name = ? ORDER BY ui.id DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([$tagName]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

