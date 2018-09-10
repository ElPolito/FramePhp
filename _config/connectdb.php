<?php 
	
	// Define your database informations
	define("HOST", "localhost");
	define("USER", "root");
	define("PASS", "");
	define("DB", "mydb");

	try{
		$db = new PDO('mysql:dbname=' . DB . ';host=' . HOST, USER, PASS);
	}catch(PDOException $e){
		echo $e;
		die();
	}

	// If you need you can define other databases

?>