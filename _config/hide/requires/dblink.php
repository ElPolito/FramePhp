<?php 
	
	$dblinks = glob("DatabaseLinks/*.php");

	foreach ($dblinks as $file) {
		require($file);
	}

?>