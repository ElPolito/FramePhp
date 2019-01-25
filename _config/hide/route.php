<?php 
	
	namespace Project\_config\hide;

	class Route {

		private $_uris = [];
		private $addSlash = [];

		public function add($uri, $controller, $moreslash = false){
			$this->_uris[trim($uri, '/')] = $controller;
			$this->addSlash[] = $moreslash;
		}

		public function submit(){
			$uri = isset($_GET['uri']) ? $_GET['uri'] : '';
			$found = false;
			$i = 0;
			foreach ($this->_uris as $key => $value) {
				$real = $key;
				if(strpos($key, "{")){
					$args = [];
					$firstStr = substr($key, 0, strpos($key, "{"));
					if(substr($uri, 0, strlen($firstStr)) == $firstStr) { // vérification première partie de chaine "totogro/{id}/toto" vérifie totogro/ 
						$a = 0;
						$b = strpos($key, "{", $a);
						$c = 0;
						$d = strlen($firstStr);
						$error = false;
						for($j = 0; $j < substr_count($key, "{"); $j++) {
							$c = strpos($uri, "/", $d);
							if($c == null) $c = strlen($uri);
							$args[] = substr($uri, $d, $c-$d);
							$a = strpos($key, "}", $b);
							$b = strpos($key, "{", $a);
							if($b == null) $b = strlen($key);
							$chain = substr($key, $a+1, $b-$a-1); // recupere le milieu de chaine
							
							$cutUri = substr($uri, $c, strlen($chain));
							$d = $c + strlen($cutUri);

							if($chain != $cutUri){
								$error = true;
								break;
							}
						}
						if(!$error) {
							if(count($args) == 1) {
								$args = $args[0];
							}
							$con = "Project\Controllers\\" . explode(":", $value)[0] . "Controller";
							$controller = new $con;
							$func = explode(":", $value)[1];
							echo strval($controller->$func($args));
							$found = true;
							break;
						}
					}
				}else{
					if($uri == $key){
						$con = "Project\Controllers\\" . explode(":", $value)[0] . "Controller";
						$controller = new $con;
						$func = explode(":", $value)[1];
						echo strval($controller->$func());
						$found = true;
						break;
					}
				}
				$i++;
			}

			if(!$found){
				http_response_code(404);
				$controller = new \Project\Controllers\ErrorController;
				echo $controller->error404();
				die();
			}
		}
	}

	$routes = new Route();

	$routing = glob("Routes/*.php");

	foreach ($routing as $file) {
		require($file);
	}

?>