<?php

function listArtists($dbConnection)
{
	if(isset($_POST["txtSearch"]))
	{
		$input = strip_tags($_POST["txtSearch"]);
		$input= htmlspecialchars($input);
		$input = mysqli_real_escape_string($dbConnection, $input);
	}
	
	else
	{
		$input = $_GET["search"];
	}	
	$strSQL = "SELECT * FROM `tblartist` WHERE `name` LIKE '%$input%'";
	$recordSet = myDBQuery($dbConnection, $strSQL);
	
	while($record = mysqli_fetch_assoc($recordSet))
	{
		echo("<hr>");
		echo("<FIELDSET><legend>Artist</legend>\n<form action=\"searchArtistSong.php\" method=\"post\" name=\"frmListArtist\">\n");
		echo("id: ".$record["id"]."<br />\n");
		echo("name: ".$record["name"]."<br />\n");
		echo("picture: ".$record["picture"]."<br />\n");
		$filePathAndName = "upload_jpg/".$record["picture"];
		echo("<img src=\"".$filePathAndName."\" alt=\"".$record["picture"]."\" class=\"imgAnimation\" /><br />\n");
		echo("</form>\n");
		echo("</fieldset>\n");
	}
	myDBFreeResult($recordSet);
}

function printSongForm()
{
echo("<FIELDSET><legend>Search</legend>\n<form action=\"searchArtistSong.php\" method=\"post\" name=\"frmSearchArtistSong\">\n");
	echo("<input type=\"text\" id=\"txtSearch\" name=\"txtSearch\" autofocus=\"autofocus\"
		required=\"required\" title=\"Search\" size=\"35\" placeholder=\"Type artist and/or song here\"/><br />\n");
	echo("<input type =\"hidden\" name=\"hidId\" id=\"hidId\" value=\"\"/>\n");	
	echo("<input type=\"submit\" id=\"btnSubmit\" name=\"btnSubmit\" value=\"Submit\"/>\n");
	echo("<input type=\"reset\" id=\"btnReset\" name=\"btnReset\" value=\"Reset\"/>\n");
	echo("</form>\n</FIELDSET>\n");
}

function listSongs($dbConnection)
{	
		
	if(isset($_POST["txtSearch"]))
	{
		$input = strip_tags($_POST["txtSearch"]);
		$input= htmlspecialchars($input);
		$input = mysqli_real_escape_string($dbConnection, $input);
	}
	
	else
	{
		$input = $_GET["search"];
	}
	
	$strSQL = "SELECT * FROM `tblsong` WHERE `title` LIKE '%$input%'";
	$recordSet = myDBQuery($dbConnection, $strSQL);
	
	while($record = mysqli_fetch_assoc($recordSet))
	{
		echo("<hr>");
		echo("<FIELDSET><legend>Song</legend>\n<form action=\"searchArtistSong.php\" method=\"post\" name=\"frmListSong\">\n");
		echo("id: ".$record["id"]."<br />\n");
		echo("artistid: ".$record["artistid"]."<br />\n");
		echo("title: ".$record["title"]."<br />\n");
		echo("sound: ".$record["sound"]."<br />\n");
		echo("count: ".$record["count"]."<br />\n");
		
		$filePathAndName = "upload_ogg/".$record["sound"];
		echo("<audio controls> <source src=\"".$filePathAndName."\" type=\"audio/ogg\"> </audio><br /> \n");
		echo("<a href=\"searchArtistSong.php?id=".$record["id"]."&amp;search=".$input."\">Like this song</a><br />");
		echo("<a href=\"addComment.php?id=".$record["id"]."&amp;sound=".$record["sound"]."\">Comment this song</a>");
		echo("</form>\n");
		echo("</fieldset>\n");
	}
	myDBFreeResult($recordSet);

	
}	
	
	
function likeSong($dbConnection)
{
	$strSQL = "UPDATE `tblsong` SET `count` = `count` + 1 WHERE `id` = ('$_GET[id]')";
 	$recordSet = myDBQuery($dbConnection, $strSQL);
	echo("You like this song!");
}


function printCommentForm($dbConnection)
{
	if(isset($_GET["id"]))
 	{
 	$id=$_GET["id"];
 	}
 	else
 	{
 	$id=$_POST["hidId"];
 	}
 	
 	$strSQL = "SELECT * FROM tblsong WHERE `id` = $id;";
	$recordSet = myDBQuery($dbConnection, $strSQL);
	$record = mysqli_fetch_assoc($recordSet);
	
	echo("<FIELDSET> <LEGEND><b>Add comment</b></LEGEND> \n");
	echo("Song to comment: <b>".$record["title"]."</b>");
	echo("<form action=\"addComment.php\" method=\"post\" name=\"frmAddComment\" id=\"frmAddComment\" enctype=\"multipart/form-data\">");
	echo("<br/>");
	echo("<textarea name=\"txtComment\" id=\"txtComment\" required=\"required\" cols=\"40\" rows=\"10\"></textarea>");
	echo("<input type=\"hidden\" name=\"hidId\" id=\"hidId\" value=\"".$id."\"/>");
	echo("<br/>");
	echo("<input type=\"submit\" name=\"btnSave\" id=\"btnSave\" value=\"Save\"/>");
	echo("<input type=\"reset\" name=\"btnReset\" value=\"Reset\"/>");
	echo("</form>");
	echo("</FIELDSET>");
}
	

function listComments($dbConnection)
{
	if(isset($_GET["id"]))
 	{
 	$id=$_GET["id"];
 	}
 	else
 	{
 	$id=$_POST["hidId"];
 	}
 
	$strSQL = "SELECT * FROM tblcomment WHERE `songid` = $id;";
	$recordSet = myDBQuery($dbConnection, $strSQL);
	
	while($record = mysqli_fetch_assoc($recordSet))
		{
		echo("<hr>");
		echo("<fieldset><legend>Comment</legend>\n<form action=\"addComment.php\" method=\"post\" name=\"frmDbComment\" enctype=\"multipart/form-data\">\n");
		echo("id: ".$record["id"]."<br />\n");
		echo("text: ".$record["text"]."<br />\n");
		echo("songid: ".$record["songid"]."<br />\n");
		echo("insertdate: ".$record["insertdate"]."<br />\n");
		
		echo("<input type=\"hidden\" name=\"hidComment\" value=\"".$record["text"]."\"/>\n");
		echo("<input type=\"hidden\" name=\"hidId\" value=\"".$record["songid"]."\"/>\n");
		echo("</form>\n");
		echo("</fieldset>\n");
		}
}


function insertComment($dbConnection)
{
$comment = strip_tags($_POST["txtComment"]);
$commentStripped = htmlspecialchars($comment);
$commentClean = mysqli_real_escape_string($dbConnection, $commentStripped);

$songId = $_POST["hidId"];

$strSQL = "INSERT INTO `dbmusic`.`tblcomment` (`text`, `songid`, `insertdate`) VALUES ('$commentClean', '$songId', CURRENT_TIMESTAMP)";

$recordSet=myDBQuery($dbConnection, $strSQL);
echo("<b>Your comment has been added(see below)!</b>");
}




