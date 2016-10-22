<?php
//funktionerna fÃ¶r artist

	function printArtistForm()
	{
		echo("<fieldset><legend>New/Update Artist</legend>\n<form action=\"adminArtist.php\" method=\"post\"
		name=\"frmNewUpdateArtist\" enctype=\"multipart/form-data\" onsubmit=\"return validateNewUpdateArtistFormData(this);\">\n");
		echo("<input type=\"hidden\" id=\"hidId\" name=\"hidId\" />\n");
		echo("<input type=\"hidden\" id=\"hidPictureFileName\" name=\"hidPictureFileName\" />\n");
		echo("<label>Artist<br /><input type=\"text\" id=\"txtArtist\" name=\"txtArtist\" autofocus=\"autofocus\"
		title=\"Artist\" size=\"35\" placeholder=\"Type the artist here\"/></label><br />\n");		
		echo("<label>Picture<br /><input type=\"file\" id=\"filePictureFileName\" name=\"filePictureFileName\"
		title=\"Picture\" /></label><br />\n");
		echo("<input type=\"submit\" id=\"btnSave\" name=\"btnSave\" value=\"Save\" />\n");
		echo("<input type=\"button\" id=\"btnReset\" name=\"btnReset\" value=\"Reset\"
		onclick=\"resetNewUpdateArtistFormData(this.form);\"/>\n");
		echo("</form>\n</fieldset>\n");
	
	}

function listArtists($dbConnection)
	{
		$strSQL = "SELECT * FROM tblartist;";
		$recordSet = myDBQuery($dbConnection, $strSQL);
		
		while($record = mysqli_fetch_assoc($recordSet))
		{
			echo("<hr>");
			echo("<fieldset><legend>Edit/Delete Artist</legend><form action=\"adminArtist.php\" method=\"post\" name=\"frmEditDeleteArtist\" onsubmit=\"return verifyDeleteOfArtist(this);\">\n");
			 echo("id: ".$record["id"]."<br />\n");
			 echo("name: ".$record["name"]."<br />\n");
			 echo("picture: ".$record["picture"]."<br />\n");
			 echo("changedate: ".$record["changedate"]."<br />\n");
			 $filePathAndName = "upload_jpg/".$record["picture"];
			
			 echo("<img src=\"".$filePathAndName."\" alt=\"".$record["picture"]."\" class=\"imgAnimation\" /><br />\n");
			 echo("<input type=\"hidden\" name=\"hidId\" value=\"".$record["id"]."\" />\n");
			 echo("<input type=\"hidden\" name=\"hidArtist\" value=\"".$record["name"]."\" />\n");
			 echo("<input type=\"hidden\" name=\"hidPictureFileName\" value=\"".$record["picture"]."\" />\n");
			 
			 echo("<input type=\"button\" name=\"btnEdit\" value=\"Edit\" onclick=\"copyEditDeleteArtistFormData(this.form);\"/>\n");
			 echo("<input type=\"submit\" name=\"btnDelete\" value=\"Delete\" />\n");
			 echo("</form>\n");
			 echo("</fieldset>\n");
		}
		
		myDBFreeResult($recordSet);
		
	}
	
	
	function insertArtist($dbConnection)
	{
		$strSQL = "INSERT INTO tblartist(id, name, picture) ";
		$strSQL .= "VALUES ('".$_POST["hidId"]."','".$_POST["txtArtist"]."','".$_FILES["filePictureFileName"]["name"]."')";
		$recordSet=myDBQuery($dbConnection, $strSQL);
	
	}
	
	function deleteArtist($dbConnection)
	{
		
		$filename = $_POST["hidPictureFileName"];
		$file = "upload_jpg/$filename";
		if(!unlink($file))
		{
			throw new Exception("Filen kunde ej raderas");
		}
		//för att ta bort låtarna kopplade till artisten från upload.ogg kolla vilka låtar som är kopplade till artisten och sedan köra unlink() för varje låt.
	
	$strSQL = "DELETE FROM `dbmusic`.`tblartist` WHERE `tblartist`.`id` = ('$_POST[hidId]')";
	$recordSet=myDBQuery($dbConnection, $strSQL);
	
	}
	
	function updateArtist($dbConnection)
	{
		
		if(!empty($_FILES["filePictureFileName"]["name"]))
		{
			$filename = $_POST["hidPictureFileName"];
			$file = "upload_jpg/$filename";
			if(!unlink($file))
			{
			throw new Exception("Filen kunde ej raderas");
			}
			
			$id = $_POST["hidId"];
			$name = $_POST["txtArtist"];
			$picture_name = $_FILES["filePictureFileName"]["name"];
			
			$strSQL = "UPDATE `dbmusic`.`tblartist` SET `name` = '$name' , `picture` = '$picture_name' WHERE `tblartist`.`id` = '$id'";
		
			$recordSet=myDBQuery($dbConnection, $strSQL);
		}
		else
		{
			$id = $_POST["hidId"];
			$name = $_POST["txtArtist"];
			
			$strSQL = "UPDATE `dbmusic`.`tblartist` SET `name` = '$name' WHERE `tblartist`.`id` = '$id'";
			
			$recordSet=myDBQuery($dbConnection, $strSQL);	
		
		}
	
	}
	
	
	