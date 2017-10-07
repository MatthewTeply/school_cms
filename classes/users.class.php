<?php
//users.class.php je určeno pro manipulaci s uživatelskými účty NIKOLIV pro jakoukoliv manipulaci s příspěvky na stránce nebo soukromými zprávami!

//Vzor : GET, SET

include '../db.inc.php';

class User {

	private $conn;

	function __construct() {

		$this->conn = DBConnection::getDB();
	}

 	public function setUser($username, $password, $email) { //Registrace uživatelů

		$hash_password = password_hash($password, PASSWORD_DEFAULT);

		$stmnt = $this->conn->prepare("INSERT INTO users (uid, pwd, em) VALUES (?, ?, ?)");
		$stmnt->bind_param("sss", $st_uid, $st_pwd, $st_em);

		$st_uid = $username;
		$st_pwd = $hash_password;
		$st_em = $email;

		$stmnt->execute();
	}

	function getUser($username, $password) { //Přihlašování uživatelů

		$stmnt = $this->conn->prepare("SELECT * FROM users WHERE uid=?");
		$stmnt->bind_param("s", $st_uid);

		$st_uid = $username;

		$stmnt->execute();
		
		$results = $stmnt->get_result();

		$row = $results->fetch_assoc();
		if(password_verify($password, $row['pwd']) === false) {

			exit("Wrong username or password!");
		}
		else {
			$_SESSION['scms_uid'] = $row['uid'];
			header("Location: ../index.php");
			return true;
		}
	}

	function un_getUser() {

		session_unset();
		session_destroy();
		header("Location: ../index.php");
	}
}