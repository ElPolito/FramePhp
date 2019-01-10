<?php 
	
	// Define your database informations
	define("HOST", "");
	define("USER", "");
	define("PASS", "");
	define("DB", "");

	if(HOST != "") {
		try{
			$db = new PDO('mysql:dbname=' . DB . ';host=' . HOST, USER, PASS);
		}catch(PDOException $e){
			echo $e;
			die();
		}	
	}

	

	// If you need you can define other databases

?>