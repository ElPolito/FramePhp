<?php 

	$services = glob("Services/*.php");

	foreach ($services as $file) {
		require($file);
	}

?>