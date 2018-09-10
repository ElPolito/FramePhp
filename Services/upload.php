<?php 
	
	/* This function allow you to upload files in UploadsFolder in a custom Folder ($folder) like "ProfilePic"
	This method return the new uniq name of the file
	*/
	function uploadFile ($file, $folder) {
		$target_dir = "Assets/Uploads/" . $folder . "/";
		$fileName = uniqid() . "." . strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
		$target_file = $target_dir . $fileName;
		$uploadOk = 1;

		$check = getimagesize($file["tmp_name"]);
		if($check === false) {
			$uploadOk = 0; 
		}

		if($file["size"] > 500000){
			$uploadOk = 0;
		}

		if($uploadOk){
			if(move_uploaded_file($file["tmp_name"], $target_file)){
				return $fileName;
			}
		}

		return false;
	}

?>