<?php

require_once __DIR__ . '/../core/Database.php';

class UserModel {
	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function findByEmail($email){
		$selectQuery = $this->pdo->prepare("select email, password from users where email = ?");
		$selectQuery->execute([$email]);
		return $selectQuery->fetch();
	}

	public function findByUsername($username){
		$selectQuery = $this->pdo->prepare("select username from users where username = ?");
		$selectQuery->execute([$username]);
		return $selectQuery->fetch();
	}

	public function fetchUsernameAvatar($email){
	    $selectQuery = $this->pdo->prepare("SELECT id, username, avatar_path FROM users WHERE email = ?");
	    $selectQuery->execute([$email]);
	    return $selectQuery->fetch(PDO::FETCH_ASSOC);
	}


	public function create($username, $email, $password){
		$hash_password = password_hash($password, PASSWORD_DEFAULT);

		$insertQuery = $this->pdo->prepare('insert into users (username, email, password) values (?, ?, ?)');
		$insertQuery->execute([$username, $email, $hash_password]);
	}
}
