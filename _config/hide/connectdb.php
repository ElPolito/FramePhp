<?php 
	
	namespace Project\_config\hide;

	class DB {

		private static $dbs = [];

		public static function addDB ($name, $host, $user, $pass, $db, $engine = "mysql") {
			try{
				DB::$dbs[$name] = new \PDO($engine . ":dbname=" . $db . ";host=" . $host, $user, $pass);	
			}catch(PDOException $e) {
				echo $e;
				die();
			}
		}

		public static function getDB ($name = null) {
			if($name == null) {
				return reset(DB::$dbs);
			}else{
				return DB::$dbs[$name];
			}
		}

	}

?>