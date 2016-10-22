<?php
function listComments($dbConnection)
{
	$strSQL = "SELECT * FROM tblcomment;";
	$recordSet = myDBQuery($dbConnection, $strSQL);
	
	while($record = mysqli_fetch_assoc($recordSet))
		{
		echo("<hr>");
		echo("<fieldset><legend>Delete Comment</legend>\n<form action=\"adminComment.php\" method=\"post\" name=\"frmDeleteComment\" enctype=\"multipart/form-data\" onsubmit=\"return verifyDeleteOfComment(this);\">\n");
		echo("id: ".$record["id"]."<br />\n");
		echo("text: ".$record["text"]."<br />\n");
		echo("songid: ".$record["songid"]."<br />\n");
		echo("insertdate: ".$record["insertdate"]."<br />\n");
		
		echo("<input type=\"hidden\" name=\"hidId\" value=\"".$record["id"]."\"/>\n");
		echo("<input type=\"hidden\" name=\"hidComment\" value=\"".$record["text"]."\"/>\n");
		echo("<input type=\"submit\" name=\"btnDelete\" value=\"Delete\" />\n");
		echo("</form>\n\n");
		echo("</fieldset>\n");
		}
}
					
function deleteComment($dbConnection)
{
	$strSQL = "DELETE FROM `dbmusic`.`tblcomment` WHERE `tblcomment`.`id` = ('$_POST[hidId]')";
	$recordSet = myDBQuery($dbConnection, $strSQL);
}

