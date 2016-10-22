<?php 
	
	function getFileExtension($inFileName)
	{
		$strFileExtension = substr($inFileName, -3);
		$strFileExtension = strtolower($strFileExtension);
		return $strFileExtension;
	}
	
	function validateArtist()
	{
		$strArtist = $_POST["txtArtist"];
		$strNewFileName = $_FILES["filePictureFileName"]["name"];
		$intPrimaryKey = $_POST["hidId"];
		
		if(empty($strArtist))
		{
			throw new Exception("Ange artist!");
		}
		
		if((strlen($intPrimaryKey) > 0) && !is_numeric($intPrimaryKey))
		{
			throw new Exception("Du försöker uppdatera en post som inte finns i databasen!");
		}
		
		//INSERT
		if(empty($intPrimaryKey)) 
		{
			if(empty($strNewFileName))
			{
				throw new Exception("Välj en fil!");
			}
			
			if(strlen($strNewFileName) < 5)
			{
				throw new Exception("Filnamnet måste vara minst 5 tecken långt!");
			}
			
			if(getFileExtension($strNewFileName) != "jpg")
			{
				throw new Exception("Endast jpg-filer är tillåtna!");
			}
		}
		
		//UPDATE
		if(isset($intPrimaryKey) && strlen($strNewFileName) > 0)
		{
			if(!empty($strNewFileName))
			{
				if(strlen($strNewFileName) < 5)
				{
					throw new Exception("Filnamnet måste vara minst 5 tecken långt!");
				}
			
				if(getFileExtension($strNewFileName) != "jpg")
				{
					throw new Exception("Endast jpg-filer är tillåtna!");
				}
			}
		}
		
	}

	function validateSong()
	{
		$intArtist = $_POST["cboArtist"];
		$strTitle = $_POST["txtTitle"];
		$intCount = $_POST["txtCount"];
		$strNewFileName = $_FILES["fileSoundFileName"]["name"];
		$intPrimaryKey = $_POST["hidId"];
		
		if(((strlen($intArtist) > 0) && !is_numeric($intArtist)) || (strlen($intArtist) > 0 && $intArtist == "0"))
		{
			throw new Exception("Välj en artist (Artist)!");
		}
		
		if(empty($strTitle))
		{
			throw new Exception("Ange en låttitel (Song)!");
		}
		
		//INSERT
		if(empty($intPrimaryKey))
		{
			if(empty($strNewFileName))
			{
				throw new Exception("Välj en fil (Sound)!");
			}

			if(strlen($strNewFileName) < 5)
			{
				throw new Exception("Filnamnet måste vara minst 5 tecken långt!");
			}
			
			if(getFileExtension($strNewFileName) != "ogg")
			{
				throw new Exception("Endast ogg-filer är tillåtna!");
			}
		}
		//UPDATE
		if(isset($intPrimaryKey) && strlen($strNewFileName) > 0)
		{
			if(!empty($strNewFileName))
			{
				if(strlen($strNewFileName) < 5)
				{
					throw new Exception("Filnamnet måste vara minst 5 tecken långt!");
				}
			
				if(getFileExtension($strNewFileName) != "ogg")
				{
					throw new Exception("Endast ogg-filer är tillåtna!");
				}
			}
		}
		
		if((((strlen($intCount) > 0) && !is_numeric($intCount))) || strlen($intCount) == 0)
		{
			throw new Exception("Ange ett heltal för \"antal gilla\" (Count)!");
		}
	}