<?php 
	
	namespace Project\_config\app;

	use Project\_config\hide\DB;

	class EloManager {

		public function __construct () {
			echo "\n ### Elo Manager ###\n\n";
			$continue = true;
			while($continue) {
				echo "framephp > elomanager$ ";
				$input = rtrim(fgets(STDIN));
				$continue = $this->processEloRequest($input);
			}
		}

		private function processEloRequest ($input) {
			$inputs = explode(" ", $input);
			switch($inputs[0]) {
				case "exit" :
					return false;
					break;
				case "create" :
					$this->processCreate ($inputs);
					break;
			}
			return true;
		}

		private function processCreate ($inputs) {
			if(count($inputs) >= 2) {
				switch($inputs[1]) {
					case "entity" :
						$this->createEntity();
						break;
					case "table" :
						$this->createTable();
						break;
					case "dao" :
						$this->createDao();
						break;
				}
			}else{
				echo "\nWrong syntax for command 'create'\n\n";
			}
		}

		private function createEntity () {
			echo "\n ### Entity creation ### \n";
			echo "\n 1. Create from scratch\n";
			echo " 2. Create from table\n";
			echo "Choose 1 or 2 to continue ... ";
			$input = rtrim(fgets(STDIN));
			if($input == "1") {
				echo "\n Entity name : ";
				$name = rtrim(fgets(STDIN));
				if(FileManager::fileExists("../../Classes/Entities/" . $name . ".php")) {
					echo "\n An entity with the same name already exists\n\n";
					return;
				}
				$file = FileManager::createFile("../../Classes/Entities/" . $name . ".php");
				fwrite($file, "<?php\n\n");
				fwrite($file, "\tnamespace Project\Classes\Entities;\n\n");
				fwrite($file, "\tclass " . ucfirst($name) . " {\n\n");
				$attrs = [];
				do{
					echo "\nAdd attribute : ";
					$attr = rtrim(fgets(STDIN));
					if($attr != "") {
						if(!in_array($attr, $attrs)) {
							$attrs[] = $attr;
						}else {
							echo "\n\n An attribute with the same name already exists\n";
						}
					}
				}while($attr != "");
				$this->createEntityClass($attrs, $file);
			}else if($input == "2") {
				$dbs = DB::$dbs;
				echo " Choose the database you want to use : \n";
				$i = 1;
				foreach ($dbs as $dbName => $db) {
					echo " " . $i . ". " . $dbName;
				}
				echo "\n Choose a database : ";
				$dbIndex = rtrim(fgets(STDIN));
				$db = $dbs[array_keys($dbs)[intval($dbIndex)-1]];
				$q = $db->prepare("show tables");
				$q->execute([]);
				$i = 1;
				$tables = [];
				while($rows = $q->fetch(\PDO::FETCH_ASSOC)){
					echo " " . $i . ". " . reset($rows) . "\n";
					$tables[] = reset($rows);
					$i++;
				}
				$q->closeCursor();
				echo "\n Choose a table : ";
				$tableIndex = rtrim(fgets(STDIN));
				$table = $tables[intval($tableIndex)-1];
				$q = $db->prepare("SELECT * FROM " . $table . " LIMIT 1");
				$q->execute([]);
				$res = $q->fetch();
				$q->closeCursor();
				$columns = array_keys($res);
				for ($i=0; $i < count($columns); $i++) {
					if(intval($columns[$i]) == 0 && $columns[$i] !== 0) {
						$columns[$i] = strtolower($columns[$i]);
					}else{
						array_splice($columns, $i, 1);
						$i--;
					}
				}
				$table = strtolower($table);
				if(FileManager::fileExists("../../Classes/Entities/" . $table . ".php")) {
					echo "\n An entity with the same name already exists\n\n";
					return;
				}
				$file = FileManager::createFile("../../Classes/Entities/" . $table . ".php");
				fwrite($file, "<?php\n\n");
				fwrite($file, "\tnamespace Project\Classes\Entities;\n\n");
				fwrite($file, "\tclass " . ucfirst($table) . " {\n\n");
				$this->createEntityClass($columns, $file);
			}
			echo "\n";
		}

		private function createEntityClass ($attrs, $file) {
			$construct = "";
			foreach ($attrs as $att) {
				fwrite($file, "\t\tprivate $" . $att . " = null;\n");
				$construct .= "$" . $att . ", ";
			}
			$construct = substr($construct, 0, strlen($construct)-2);
			fwrite($file, "\n\t\tpublic function __construct (" . $construct . ") {\n");
			foreach ($attrs as $att) {
				fwrite($file, "\t\t\t\$this->" . $att . " = " . "$" . $att . ";\n");
			}
			fwrite($file, "\t\t}\n");
			foreach ($attrs as $att) {
				fwrite($file, "\n\t\tpublic function get" . ucfirst($att) . " () {");
				fwrite($file, "\n\t\t\treturn \$this->" . $att . ";\n");
				fwrite($file, "\t\t}\n");
				fwrite($file, "\n\t\tpublic function set" . ucfirst($att) . " ($" . $att . ") {");
				fwrite($file, "\n\t\t\t\$this->" . $att . " = $" . $att . ";\n");
				fwrite($file, "\t\t}\n");
			}
			fwrite($file, "\n\t}\n\n");
			fwrite($file, "?>");
		}

		private function createTable () {
			echo "\n ### Table creation ### \n";
			$dbs = DB::$dbs;
			echo " Choose the database you want to use : \n";
			$i = 1;
			foreach ($dbs as $dbName => $db) {
				echo " " . $i . ". " . $dbName;
			}
			echo "\n Choose a database : ";
			$dbIndex = rtrim(fgets(STDIN));
			$db = $dbs[array_keys($dbs)[intval($dbIndex)-1]];
			$q = $db->prepare("show tables");
			$q->execute([]);
			$tables = [];
			while($rows = $q->fetch(\PDO::FETCH_ASSOC)){
				$tables[] = reset($rows);
			}
			$q->closeCursor();
			echo "\n Table name : ";
			$name = rtrim(fgets(STDIN));
			while(in_array($name, $tables)) {
				echo " There's already a table with the same name.";
				echo "\n Table name : ";
				$name = rtrim(fgets(STDIN));
			}
			$attrs = [];
			$attrsType = [];
			do{
				echo " Attribute name : ";
				$att = rtrim(fgets(STDIN));
				if($att != "") {
					if(!in_array($att, $attrs)){
						$attrs[] = $att;
						$attrsType[] = $this->selectDataType();
					}else{
						echo " This attribute already exists. \n";
					}
				}
			}while($att != "");
			$sql = "CREATE TABLE " . $name . " (";
			for ($i=0; $i < count($attrs); $i++) { 
				$sql .= $attrs[$i] . " ";
				if($attrsType[$i] == "varchar"){
					$sql .= "varchar(255)";
				}else{
					$sql .= $attrsType[$i];
				}
				if($i+1 < count($attrs)) {
					$sql .= ", ";
				}
			}
			$sql .= ")";
			$q = $db->prepare($sql);
			$q->execute([]);
			$q->closeCursor();

			echo "\n Do you want to create an entity for this table ? Y/N";
			$answer = rtrim(fgets(STDIN));
			if($answer == "y" || $answer == "Y"){
				$table = strtolower($name);
				if(FileManager::fileExists("../../Classes/Entities/" . $table . ".php")) {
					echo "\n An entity with the same name already exists\n\n";
				}else{
					$file = FileManager::createFile("../../Classes/Entities/" . $table . ".php");
					fwrite($file, "<?php\n\n");
					fwrite($file, "\tnamespace Project\Classes\Entities;\n\n");
					fwrite($file, "\tclass " . ucfirst($table) . " {\n\n");
					$this->createEntityClass($attrs, $file);	
				}
			}

			echo "\n Do you want to create a dao class for this table ? Y/N";
			$answer = rtrim(fgets(STDIN));
			if($answer == "y" || $answer == "Y") {
				$name = strtolower($name);
				if(FileManager::fileExists("../../DatabaseLinks/" . $name . "DAO.php")) {
					echo "\n A dao class with the same name already exists\n\n";
				}else{
					$file = FileManager::createFile("../../DatabaseLinks/" . $name . "DAO.php");
					$this->createDAOClass($file, $name, $attrs);
				}
			}
		}

		private function createDAOClass ($file, $name, $attrs) {
			fwrite($file, "<?php\n\n");
			fwrite($file, "\tnamespace Project\DatabaseLinks;\n\n");
			fwrite($file, "\tuse Project\_config\DAO;\n");
			fwrite($file, "\tuse Project\Classes\Entities\\" . ucfirst($name) . ";\n\n");
			fwrite($file, "\tclass " . ucfirst($name) . "DAO {\n\n");
			echo "\n Add an all row getter ? Y/N";
			$answer = rtrim(fgets(STDIN));
			if($answer == "y" || $answer == "Y"){
				fwrite($file, "\t\tpublic static function getAll" . ucfirst($name) . "s () {\n");
				fwrite($file, "\t\t\t\$datas = DAO::queryAll(\"SELECT * FROM " . $name . "\");\n");
				fwrite($file, "\t\t\t\$result = [];\n");
				fwrite($file, "\t\t\tforeach (\$datas as \$value) {\n");
				$toAdd = "\t\t\t\t\$result[] = new " . ucfirst($name) . " (";
				foreach ($attrs as $att) {
					$toAdd .= "\$value['" . $att . "'], ";
				}
				$toAdd = substr($toAdd, 0, strlen($toAdd) - 2);
				$toAdd .= ");";
				fwrite($file, $toAdd);
				fwrite($file, "\n\t\t\t}\n");	
				fwrite($file, "\t\t\treturn \$result;\n");
				fwrite($file, "\t\t}\n\n");
			}
			echo "\n Add an update row function ? Y/N";
			$answer = rtrim(fgets(STDIN));
			if($answer == "y" || $answer == "Y") {
				echo "\n Select your identifier : ";
				$identifier = rtrim(fgets(STDIN));
				fwrite($file, "\t\tpublic static function update" . ucfirst($name) . " ($" . $name . ") {\n");
				$toAdd = "\t\t\tDAO::queryRow('UPDATE " . $name . " SET ";
				foreach ($attrs as $att) {
					if($att != $identifier) {
						$toAdd .= $att . " = ?, ";	
					}
				}
				$toAdd = substr($toAdd, 0, strlen($toAdd) - 2);
				$toAdd .= " WHERE " . $identifier . " = ?', [";
				foreach ($attrs as $att) {
					if($att != $identifier) {
						$toAdd .= "$" . $name . "->get" . ucfirst($att) . "(), ";
					}
				}
				$toAdd = substr($toAdd, 0, strlen($toAdd) - 2);
				$toAdd .= "]);";
				fwrite($file, $toAdd);
				fwrite($file, "\n\t\t}\n\n");	
			}
			echo "\n Add a delete row function ? Y/N";
			$answer = rtrim(fgets(STDIN));
			if($answer == "y" || $answer == "Y") {
				echo "\n Select your identifier : ";
				$identifier = rtrim(fgets(STDIN));
				fwrite($file, "\t\tpublic static function delete" . ucfirst($name) . " ($" . $name . ") {\n");
				$toAdd = "\t\t\tDAO::queryRow('DELETE FROM " . $name . " WHERE " . $identifier . " = ?',";
				$toAdd .= "[$" . $name . "->get" . ucfirst($identifier) . "()]);";
				fwrite($file, $toAdd);
				fwrite($file, "\n\t\t}\n\n");	
			}
			echo "\n Add a select by identifier function ? Y/N";
			$answer = rtrim(fgets(STDIN));
			if($answer == "y" || $answer == "Y") {
				echo "\n Select your identifier : ";
				$identifier = rtrim(fgets(STDIN));
				fwrite($file, "\t\tpublic static function get" . ucfirst($name) . "By" . ucfirst($identifier) . " ($" . $identifier . ") {\n");
				$toAdd = "\t\t\t\$data = DAO::queryRow('SELECT * FROM " . $name . " WHERE " . $identifier . " = ?',";
				$toAdd .= "[$" . $name . "->get" . ucfirst($identifier) . "()]);";
				fwrite($file, $toAdd);
				$toAdd = "\$result = new " . ucfirst($name) . " (";
				foreach ($attrs as $att) {
					$toAdd .= "\$value['" . $att . "'], ";
				}
				$toAdd = substr($toAdd, 0, strlen($toAdd) - 2);
				$toAdd .= ");";
				fwrite($file, $toAdd);
				fwrite($file, "\t\t\treturn \$result;");
				fwrite($file, "\n\t\t}\n\n");	
			}
			fwrite($file, "\n\t}\n\n");
			fwrite($file, "?>");
		}

		private function selectDataType () {
			$attTypes = ["int", "varchar", "text", "date", "float", "datetime", "timestamp", "time"];
			do {
				echo " Attribute type : ";
				$attType = rtrim(fgets(STDIN));
				if(!in_array($attType, $attTypes)){
					echo " This attribute doesn't exists.\n";
				}
			}while(!in_array($attType, $attTypes));
			
			return $attType;
		}

		private function createDao () {
			echo "\n ### Dao creation ### \n";
			$dbs = DB::$dbs;
			echo " Choose the database you want to use : \n";
			$i = 1;
			foreach ($dbs as $dbName => $db) {
				echo " " . $i . ". " . $dbName;
			}
			echo "\n Choose a database : ";
			$dbIndex = rtrim(fgets(STDIN));
			$db = $dbs[array_keys($dbs)[intval($dbIndex)-1]];
			$q = $db->prepare("show tables");
			$q->execute([]);
			$i = 1;
			$tables = [];
			while($rows = $q->fetch(\PDO::FETCH_ASSOC)){
				echo " " . $i . ". " . reset($rows) . "\n";
				$tables[] = reset($rows);
				$i++;
			}
			$q->closeCursor();
			echo "\n Choose a table : ";
			$tableIndex = rtrim(fgets(STDIN));
			$table = $tables[intval($tableIndex)-1];
			$q = $db->prepare("SELECT * FROM " . $table . " LIMIT 1");
			$q->execute([]);
			$res = $q->fetch();
			$q->closeCursor();
			$columns = array_keys($res);
			for ($i=0; $i < count($columns); $i++) {
				if(intval($columns[$i]) == 0 && $columns[$i] !== 0) {
					$columns[$i] = strtolower($columns[$i]);
				}else{
					array_splice($columns, $i, 1);
					$i--;
				}
			}
			$name = strtolower($table);
			if(FileManager::fileExists("../../DatabaseLinks/" . $name . ".php")) {
				echo "\n A dao with the same name already exists\n\n";
				return;
			}
			$file = FileManager::createFile("../../DatabaseLinks/" . $name . ".php");
			$this->createDAOClass($file, $name, $columns);
		}
	}


?>