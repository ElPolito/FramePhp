<?php 
	
	namespace Project\Services;

	use Project\Controllers;

	class Redirect {

		// This service allow you to redirect your visitors to a 404 error page
		// You can custom this page in Templates/_Errors/404.php 
		public function redirectToError () {
			http_response_code(404);
			$controller = new ErrorController ();
			echo $controller->error404();
			die();
		}	

	}

?>