<?php
   
	function validateAndMoveUploadedFile($inFileExtension)
	{
		$uploadErrorMsg = array(
			0 => "There is no error, the file uploaded with success",
			1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
			2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
			3 => "The uploaded file was only partially uploaded",
			4 => "No file was uploaded",
			6 => "Missing a temporary folder",
			7 => "File can not be written to disk",
			8 => "An issue with PHPs configuration caused the upload to fail"
		);
		
		$fileComponent = "";
		$inFileExtension = strtolower($inFileExtension);
		
		if($inFileExtension == "jpg")
		{
			$fileComponent = "filePictureFileName";
		}
		else
		{
			$fileComponent = "fileSoundFileName";
		}
		
		define("PATH", $_SERVER["DOCUMENT_ROOT"]."musicsite/upload_".$inFileExtension."/");
	
		if(empty($_FILES) && empty($_POST) && isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] == "POST"))
		{
			throw new Exception("Du försöke skicka för mycket data.<br />\n'max_post_size' är idag satt till ".ini_get("post_max_size"));
		}
		
		if($_FILES[$fileComponent]["error"] != UPLOAD_ERR_OK)
		{
			throw new Exception($uploadErrorMsg[$_FILES[$fileComponent]["error"]]);
		}

		$fileExtension = substr($_FILES[$fileComponent]["name"], -3);
		$fileExtension = strtolower($fileExtension);
		if($fileExtension != $inFileExtension)
		{
			throw new Exception("Endast filer med filändelsen ".$inFileExtension." är giltiga!");
		}
		
		if(move_uploaded_file($_FILES[$fileComponent]["tmp_name"], PATH.$_FILES[$fileComponent]["name"]) == FALSE)
		{
			throw new Exception("Det gick inte att flytta ".$_FILES[$fileComponent]["name"]);
		}

	}
