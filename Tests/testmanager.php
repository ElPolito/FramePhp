<?php 

	namespace Project\Tests;

	use Project\Controllers\DefaultController;
	use Project\Tests\TestDefault;

	class TestManager {

		public function __construct () {
			
		}

		public function executeTests () {
			// You can make tests here
			
			// You can either call functions in this class
			if(!$this->testHome()) return false;
			// Or in other test class
			$testDefault = new TestDefault();
			if(!$testDefault->executeTests()) return false;
			return true;
		}

		private function testHome () {
			// This test only prints the parameters transmitted to the template
			$controller = new DefaultController ();
			if(count($controller->home()["users"]) == 1) {
				return true;
			}else{
				throw new \Exception("Error nb users");
			}
		}

	}

?>