<?php 
	
	$entities = glob("Classes/Entities/*.php");

	foreach ($entities as $file) {
		require($file);
	}

?>