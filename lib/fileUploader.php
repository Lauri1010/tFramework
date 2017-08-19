<?php

function uploadFile($allowedFileTypes=array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG),$filename='uploaded',$uploadDir='uploads'){

	if (!empty($_FILES[$filename])) {
		$uploaded = $_FILES[$filename];
	
		if ($uploaded["error"] !== UPLOAD_ERR_OK) {
			echo "<p>An error occurred.</p>";
			exit;
		}
		
		// verify the file is a GIF, JPEG, or PNG
		$fileType = exif_imagetype($_FILES[$filename]["tmp_name"]);
		$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
		
		if (!in_array($fileType, $allowed)) {
			 die('file type not permitted');
		}
	
		// ensure a safe filename
		$name = preg_replace("/[^A-Z0-9._-]/i", "_", $uploaded["name"]);
	
		// don't overwrite an existing file
		$i = 0;
		$parts = pathinfo($name);
		while (file_exists(UPLOAD_DIR . $name)) {
			$i++;
			$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
	
		// preserve file from temporary directory
		$success = move_uploaded_file($uploaded["tmp_name"],
				UPLOAD_DIR . $name);
		if (!$success) {
			echo "<p>Unable to save file.</p>";
			exit;
		}
	
		// set proper permissions on the new file
		chmod(UPLOAD_DIR . $name, 0644);
	}
}
