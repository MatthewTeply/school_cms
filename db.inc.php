<?php

//Tzv. Singleton (Vrací pouze vlastní instanci)
//Složitější, ale úsporná metoda pro připojení k databázi, bez této classy, bychom museli definovat proměnnou pro připojení individuálně

class DBConnection {

	private static $instance = null; //Vytvoříme instanci $instance, kterou později definujeme

	private $conn; //Vytvoříme proměnnou $conn
	private function __construct() {

		$this->conn = mysqli_connect("localhost", "root", "", "school_cms"); //Proměnnou definujeme objektem mysqli_connect, připojení k databázi
	}

	public static function getDB() {

		if (self::$instance === null) { //Jelikož $instance se vždy rovná NULL, toto proběhně při zavolání funkce
			self::$instance = new self(); //Vytvoříme instanci této classy, tím získáme žádanou proměnnou $conn, pro připojení k databázi
		}

		return self::$instance->conn; //Vrátíme proměnnou $conn
	}

}

