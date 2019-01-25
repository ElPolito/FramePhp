<?php 
	use Project\_config\hide\Translation;

	// User Entity (for connection)
	require "_config/hide/requires/entity.php";
	// End

	session_start();

	// Config
	require "_config/utilities/DAO.php";
	require "_config/utilities/controller.php";
	require "_config/hide/requires/defines.php";
	require "_config/hide/translation.php";
	$translate = new Translation();
	require "_config/hide/route.php";
	require "_config/hide/template.php";
	if(USETWIG) require "_config/hide/twigtemplate.php";
	require "_config/hide/requires/controller.php";
	require "_config/hide/requires/services.php";
	require "_config/hide/requires/dblink.php";
	require "_config/hide/connectdb.php";
	// End

	// Your script(s) to interact with the database(s)
	require "_config/databases.php";
	// End


?>