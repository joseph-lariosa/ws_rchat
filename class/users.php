<?php 
	class users {
		private $id;
        private $username;
        private $password;
        private $email;    
        private $loginStatus;
		private $lastLogin;

        
		public $dbConn;

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setUsername($username) { $this->username = $username; }
        function getUsername() { return $this->username; }
        
        function setPassword($password) { $this->password = $password; }
        function getPassword() { return $this->password; }

        function setEmail($email) { $this->email = $email; }
        function getEmail() { return $this->email; }



        function setLoginStatus($loginStatus) { $this->loginStatus = $loginStatus; }
		function getLoginStatus() { return $this->loginStatus; }
		function setLastLogin($lastLogin) { $this->lastLogin = $lastLogin; }
		function getLastLogin() { return $this->lastLogin; }
    
        
	

		public function __construct() {
			require_once("DbConnect.php");
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		public function save() {
            $sql = "INSERT INTO `users`(`userid`, `username`, `password`, `email`, `login_status`, `last_login`) VALUES (null, :username, :password, :email, :loginStatus, :lastLogin)";

			$stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":loginStatus", $this->loginStatus);
			$stmt->bindParam(":lastLogin", $this->lastLogin);
		
			try {
				if($stmt->execute()) {
					return true;
				} else {
					return false;
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		public function getUserByUserName() {
			$stmt = $this->dbConn->prepare('SELECT * FROM users WHERE username = :username');
			$stmt->bindParam(':username', $this->username);
			try {
				if($stmt->execute()) {
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			return $user;
		}

		// public function updateLoginStatus() {
		// 	$stmt = $this->dbConn->prepare('UPDATE users SET login_status = :loginStatus, last_login = :lastLogin WHERE userid = :id');
		// 	$stmt->bindParam(':loginStatus', $this->loginStatus);
		// 	$stmt->bindParam(':lastLogin', $this->lastLogin);
		// 	$stmt->bindParam(':userid', $this->id);
		// 	try {
		// 		if($stmt->execute()) {
		// 			return true;
		// 		} else {
		// 			return false;
		// 		}
		// 	} catch (Exception $e) {
		// 		echo $e->getMessage();
		// 	}
		// }

		public function getAllUsers() {
			$stmt = $this->dbConn->prepare("SELECT * FROM users");
			$stmt->execute();
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $users;
		}

	}