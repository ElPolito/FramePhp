<?php 
	

	class Template {

		private $content;

		public function __construct ($view, $param = null) {
			define("ASSET", "/Assets/");
			define("PATH", "/");
			require "_config/hide/translation.php";
			$translate = new Translation();
			$filePath = "Templates/" . explode(":",$view)[0] . "/" . explode(":", $view)[1] . ".php";
			$file = file_get_contents($filePath);
			$content = eval("?>$file");
			$this->content = $content;
		}

		public function showTime(){
			return $this->content;
		}

	}

?>