<?php 
	
	$controllers = glob("Controllers/*.php");

	foreach ($controllers as $file) {
		require($file);
	}

?>