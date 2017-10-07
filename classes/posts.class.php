<?php

include 'db.inc.php';
//posts.class.php je určeno pro vše spojené s PŘÍSPĚVKY na stránku, NIKOLIV soukromé zprávy, uživatelské účty, atd.!

//Vzor : GET, SET

include '../db.inc.php';

class Post {

	private $conn; //Vytvoříme proměnou $conn, kterou později definujeme s DBConnection::getDB()

	function __construct() {

		$this->conn = DBConnection::getDB(); //Do proměnné $conn dosazujeme proměnnou pro připojení k databázi
	}

	public function setPost($content, $op) { //Jednoduchá metoda (funkce) pro vkládání do tabulky 'posts'

		$stmnt = $this->conn->prepare("INSERT INTO posts (content, op) VALUES (?, ?)");
		$stmnt->bind_param("ss", $st_content, $op);

		$st_content = $content;
		$st_op = $op;

		$stmnt->execute();
	}

	public function showPost() { //Jednoduchá metoda (funkce) pro vypsání všech příspěvků v tabulce 'posts'

		$stmnt = $this->conn->prepare("SELECT * FROM posts");
		$stmnt->execute();

		$results = $stmnt->get_result();

		while($row = $results->fetch_assoc()) {

			echo $row['content']."<br>By : ".$row['op']."<br><br>";
		}		
	}

}