<?php 
	use Project\_config\Translation;

	// User Entity (for connection)
	require "_config/hide/entity.php";
	// End

	session_start();

	// Config
	require "_config/utilities/DAO.php";
	require "_config/hide/defines.php";
	require "_config/hide/translation.php";
	$translate = new Translation();
	require "_config/hide/route.php";
	require "_config/hide/template.php";
	require "_config/hide/controller.php";
	require "_config/hide/services.php";
	require "_config/hide/dblink.php";
	// End

	// Your script(s) to interact with the database(s)
	require "_config/connectdb.php";
	// End


?>