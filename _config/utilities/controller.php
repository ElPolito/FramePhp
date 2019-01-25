<?php 
	
	namespace Project\_config\utilities;

	use Project\_config\hide\Template;
	use Project\_config\hide\TwigTemplate;

	class Controller {
		public function __construct (){

		}

		public function template ($path, $args = null) {
			return new Template($path, $args);
		}

		public function twigtemplate ($path, $args = array()){
			return new TwigTemplate ($path, $args);
		}
	}

?>