<?php 

	namespace Project\Tests;

	use Project\Controllers\DefaultController;

	class TestDefault {
		
		public function executeTests () {
			// This test only prints the parameters transmitted to the template
			$controller = new DefaultController ();
			if(count($controller->home()["users"]) == 1){
				return true;
			}else{
				return false;
			}
		}
	}


?>