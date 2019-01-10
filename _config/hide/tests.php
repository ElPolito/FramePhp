<?php 
	
	$tests = glob("Tests/*.php");

	foreach ($tests as $file) {
		require($file);
	}



?>