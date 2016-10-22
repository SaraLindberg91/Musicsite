<?php
function printSongForm($dbConnection)
{
		echo("<fieldset><legend>New/Update Song</legend>\n<form action=\"adminSong.php\" method=\"post\"
		name=\"frmNewUpdateSong\" enctype=\"multipart/form-data\" onsubmit=\"return validateNewUpdateSongFormData(this);\">\n");
		echo("<input type=\"hidden\" id=\"hidId\" name=\"hidId\" />\n");
		echo("<input type=\"hidden\" id=\"hidSoundFileName\" name=\"hidSoundFileName\"/>\n");
		listArtists($dbConnection);
		echo("<br /> \n<label>Song<br /><input type=\"text\" id=\"txtTitle\" name=\"txtTitle\" autofocus=\"autofocus\"
		title=\"Song\" size=\"35\" placeholder=\"Type the song title here\"/></label><br />\n");
		echo("<label>Sound<br /><input type=\"file\" id=\"fileSoundFileName\" name=\"fileSoundFileName\"
		title=\"Sound\" /></label><br />\n");
		echo("<label>Count<br /><input type=\"text\" id=\"txtCount\" name=\"txtCount\"/></label><br />\n");
		echo("<input type=\"submit\" id=\"btnSave\" name=\"btnSave\" value=\"Save\" />\n");
		echo("<input type=\"button\" id=\"btnReset\" name=\"btnReset\" value=\"Reset\"
		onclick=\"resetNewUpdateSongFormData(this.form);\"/>\n");
		echo("</form>\n</fieldset>\n");

}
function listSongs($dbConnection)
{
		$strSQL = "SELECT * FROM tblsong;";
		$recordSet = myDBQuery($dbConnection, $strSQL);
		
		while($record = mysqli_fetch_assoc($recordSet))
		{
			echo("<hr>");
			echo("<fieldset><legend>Edit/Delete Song</legend>\n<form action=\"adminSong.php\" method=\"post\" name=\"frmEditDeleteSong\" onsubmit=\"return verifyDeleteOfSong(this);\">\n");
			 echo("id: ".$record["id"]."<br />\n");
			 echo("title: ".$record["title"]."<br />\n");
			 echo("sound: ".$record["sound"]."<br />\n");
			 echo("count: ".$record["count"]."<br />\n");
			 echo("artistid: ".$record["artistid"]."<br />\n");
			 echo("changedate: ".$record["changedate"]."<br />\n");
			 $filePathAndName = "upload_ogg/".$record["sound"];
			
			 echo("<input type=\"hidden\" name=\"hidId\" value=\"".$record["id"]."\" />\n");
			 echo("<input type=\"hidden\" name=\"hidTitle\" value=\"".$record["title"]."\" />\n");
			 echo("<input type=\"hidden\" name=\"hidArtistId\" value=\"".$record["artistid"]."\" />\n");
			 echo("<input type=\"hidden\" name=\"hidCount\" value=\"".$record["count"]."\" />\n");
			 echo("<input type=\"hidden\" name=\"hidSoundFileName\" value=\"".$record["sound"]."\" />\n");
			 echo("<audio controls> <source src=\"".$filePathAndName."\" type=\"audio/ogg\"> </audio><br /> \n");
			 echo("<input type=\"button\" name=\"btnEdit\" value=\"Edit\" onclick=\"copyEditDeleteSongFormData(this.form);\"/>\n");
			 
			 
			 echo("<input type=\"submit\" name=\"btnDelete\" value=\"Delete\" />\n");
			 echo("</form>\n\n");
			 echo("</fieldset>\n");
		}		
		
		myDBFreeResult($recordSet);
}


function listArtists($dbConnection)
{
	$strSQL = "SELECT * FROM tblartist;";
	$recordSet = myDBQuery($dbConnection, $strSQL);
	$options = "";
		echo("<label>Artist</label><br /> \n");
		echo("<SELECT NAME= \"cboArtist\" ID=\"cboArtist\">");
		echo("<option value=\"0\"> Choose artist</option>");
		
		while($record = mysqli_fetch_assoc($recordSet))
		{
			$id = $record["id"];
			$name = $record["name"];
			$options ="<OPTION VALUE=\"$id\">".$name. '</option>';
			echo($options);
			
		}
		echo("</select>");
	myDBFreeResult($recordSet);
}


function insertSong($dbConnection)
{
	$strSQL = "INSERT INTO dbmusic.tblsong(id, title, sound, count, artistid)";
	$strSQL .= "VALUES ('".$_POST["hidId"]."','".$_POST["txtTitle"]."','".$_FILES["fileSoundFileName"]["name"]."','".$_POST["txtCount"]."','".$_POST["cboArtist"]."')";
	$recordSet=myDBQuery($dbConnection, $strSQL);
}




function updateSong($dbConnection)
{
	if(!empty($_FILES["fileSoundFileName"]["name"]))
	{
		$filename = $_POST["hidSoundFileName"];
		$file = "upload_ogg/$filename";
		if(!unlink($file))
		{
			throw new Exception("Filen kunde ej raderas");
		}
		$sound_name = $_FILES["fileSoundFileName"]["name"];
		$id = $_POST["hidId"];
		$title = $_POST["txtTitle"];

		$strSQL = "UPDATE `dbmusic`.`tblsong` SET `sound` = '$sound_name' , `title` = '$title' WHERE `tblsong`.`id` = '$id'";
		$recordSet=myDBQuery($dbConnection, $strSQL);
		}
		else
		{
			$id = $_POST["hidId"];
			$title = $_POST["txtTitle"];
			
			$strSQL = "UPDATE `dbmusic`.`tblsong` SET `title` = '$title' WHERE `tblsong`.`id` = '$id'";
			$recordSet=myDBQuery($dbConnection, $strSQL);
			
		}
}




function deleteSong($dbConnection)
{

		$filename = $_POST["hidSoundFileName"];
		$file = "upload_ogg/$filename";
		if(!unlink($file))
		{
			throw new Exception("Filen kunde ej raderas");
		}

		$strSQL = "DELETE FROM `dbmusic`.`tblsong` WHERE `tblsong`.`id` = ('$_POST[hidId]')";
		$recordSet=myDBQuery($dbConnection, $strSQL);

}
