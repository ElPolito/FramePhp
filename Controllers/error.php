<?php 
	
	namespace Project\Controllers;

	use Project\_config\utilities\Controller;
	
	class ErrorController extends Controller{

		// Home Page ...
		public function error404 () {
			// This is how you can use templates
			$view = $this->template("_Errors:404");
			return $view->showTime();
		}
		// ... END

	}

?>