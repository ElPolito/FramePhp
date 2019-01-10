<?php 
	
	namespace Project\_config;

	class Template {

		private $content;
		private $params;

		public function __construct ($view, $param = null) {
			if(!TESTS){
				$translate = new Translation();
				$filePath = "Templates/" . explode(":",$view)[0] . "/" . explode(":", $view)[1] . ".php";
				$file = file_get_contents($filePath);
				$content = eval("?>$file");
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