<?php 
	
	namespace Project\Controllers;

	use Project\_config\utilities\Controller;
	use Project\DatabaseLinks\UserDAO;
	
	// This is a demo class for a controller
	/*
	A controller must have the same name as the file with a first capital letter and must be followed by 'Controller'
	You can create as much controller as you need
	*/
	class DefaultController extends Controller{

		
		// Home Page ...
		public function home () {
			
			$users = UserDAO::getAllUsers();

			// This is how you can use templates
			$view = $this->template("Global:home", array("users" => $users));
			return $view->showTime();

			// However you can also just send text
			// return "toto";
		}
		// ... END

	}

?>