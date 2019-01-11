<?php 
	
	$defines = glob("Defines/*.php");

	foreach ($defines as $file) {
		require($file);
	}

?>