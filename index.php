<?php 
	
	// User Entity (for connection)
	require "Classes/Entities/user.php";
	// End

	session_start();

	// Config
	require "_config/hide/route.php";
	require "_config/hide/template.php";
	require "_config/hide/controller.php";
	require "_config/hide/services.php";
	require "_config/hide/dblink.php";
	// End

	// Your script(s) to interact with the database(s)
	require "_config/connectdb.php";
	// End

	$routes->submit();
?>