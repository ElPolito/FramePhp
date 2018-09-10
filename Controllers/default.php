<?php 
	
	// This is a demo class for a controller
	/*
	A controller must have the same name as the file with a first capital letter and must be followed by 'Controller'
	You can create as much controller as you need
	*/
	class DefaultController {

		
		// Home Page ...
		public function home () {
			
			// This is how you can use templates
			$view = new Template("Global:home");
			return $view->showTime();

			// However you can also just send text
			// return "toto";
		}
		// ... END

	}

?>