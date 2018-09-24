<?php 
	
	class Route {

		private $_uris = [];
		private $addSlash = [];

		public function add($uri, $controller, $moreslash = false){
			$this->_uris[trim($uri, '/')] = $controller;
			$addSlash[] = $moreslash;
		}

		public function submit(){
			$uri = isset($_GET['uri']) ? $_GET['uri'] : '';
			$found = false;
			$i = 0;
			foreach ($this->_uris as $key => $value) {
				$real = $key;
				if(strpos($key, "{")){
					$real = substr($real, 0,strpos($key, "{"));

					if(substr($uri, 0, strlen($real)) == $real){
						if($uri == $key){
							$con = explode(":", $value)[0] . "Controller";
							$controller = new $con;
							$func = explode(":", $value)[1];
							echo strval($controller->$func());
							$found = true;
							break;
						}else{
							if(substr_count($key, "/") === substr_count($uri, "/")){
								$args = substr($uri, strlen($real), strlen($uri));
								$con = explode(":", $value)[0] . "Controller";
								$controller = new $con;
								$func = explode(":", $value)[1];
								echo strval($controller->$func($args));
								$found = true;
								break;
							}else if($addSlash[$i]){
								$args = substr($uri, strlen($real), strlen($uri));
								$con = explode(":", $value)[0] . "Controller";
								$controller = new $con;
								$func = explode(":", $value)[1];
								echo strval($controller->$func($args));
								$found = true;
								break;
							}
						}
					}
				}else{
					if($uri == $key){
						$con = explode(":", $value)[0] . "Controller";
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
				require("Templates/_Errors/404.php");
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