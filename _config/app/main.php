<?php 
	
	namespace Project\_config\app;

	use Project\_config\app\EloManager;
	use Project\_config\app\FileManager;

	class Main {

		public function __construct () {
			$continue = true;
			while($continue) {
				echo "framephp$ ";
				$input = rtrim(fgets(STDIN));
				$continue = $this->processRequest($input);
			}
		}

		private function processRequest ($input) {
			$inputs = explode(" ", $input);
			switch($inputs[0]) {
				case "exit" :
					return false;
					break;
				case "elomanager" :
					new EloManager();
					break;
				case "create" :
					$this->processCreate($inputs);
					break;
			}
			return true;
		}

		private function processCreate ($inputs) {
			if(count($inputs) >= 2) {
				switch($inputs[1]) {
					case "controller" :
						$this->createController ();
						break;
				}	
			}else{
				echo "\nWrong syntax for command 'create'\n\n";
			}
			
		}

		private function createController () {
			echo "\n ### Controller creation ### \n";
			echo "\n Controller name : ";
			$input = rtrim(fgets(STDIN));
			echo "\n Creating controller " . $input . " ...\n";
			if(FileManager::fileExists("../../Controllers/" . $input . ".php")){
				echo "\n A controller with the same name already exists\n\n";
				return;
			}
			$file = FileManager::createFile ("../../Controllers/" . $input . ".php");
			fwrite($file,"<?php\n\n");
			fwrite($file,"\tnamespace Project\Controllers;\n\n");
			fwrite($file, "\tuse Project\_config\utilities\Controller;\n");
			fwrite($file, "\tuse Project\DatabaseLinks\UserDAO;\n\n");
			fwrite($file, "\tclass " . ucfirst($input) . "Controller extends Controller {\n\n\n\n");
			fwrite($file, "\t}\n\n");
			fwrite($file, "?>");
			echo "\n";
		}

	}




?>