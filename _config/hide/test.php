<?php 
	
	use Project\Tests\TestManager;

	define("TESTS", true);
	define("USETWIG", false);

	// Config
	require "_config/hide/init.php";
	require "_config/hide/tests.php";
	// End 

	// Run tests
	$testManager = new TestManager();
	$result = $testManager->executeTests();
	if(!$result) throw new Exception("Error while running tests");
	echo "All tests passed";
	// End

?>