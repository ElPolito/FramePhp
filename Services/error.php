<?php 
	
	// This service allow you to redirect your visitors to a 404 error page
	// You can custom this page in Templates/_Errors/404.php 
	function redirectToError () {
		http_response_code(404);
		require("Templates/_Errors/404.php");
		die();
	}

?>