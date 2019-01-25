<?php 
	
	namespace Project\_config\hide;


	class TwigTemplate {

		private $content;
		private $params;

		public function __construct ($view, $param = array()) {
			if(!TESTS){
				$translate = new Translation();
				$filePath = explode(":",$view)[0] . "/" . explode(":", $view)[1] . ".twig";
				require_once 'vendor/autoload.php';
				$loader = new \Twig_Loader_Filesystem("Templates/");
				if(PRODUCTION) {
					$twig = new \Twig_Environment($loader, [
						'cache' => 'Cache/',
					]);	
				}else{
					$twig = new \Twig_Environment($loader);
				}
				$templ = $twig->load($filePath);
				$content = $templ->render($param);
				$this->content = $content;
			}else{
				$this->params = $param;	
			}
		}

		public function showTime(){
			if(!TESTS){
				return $this->content;	
			}else{
				return $this->params;
			}
			
		}

	}

?>