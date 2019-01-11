<?php 
	
	namespace Project\_config\utilities;

	use Project\_config\hide\Template;

	class Controller {
		public function __construct (){

		}

		public function template ($path, $args = null) {
			return new Template($path, $args);
		}
	}

?>