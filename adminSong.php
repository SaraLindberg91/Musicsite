<?php
	include("incl/debug.php");
	$title = "MusicSite/AdminSong";
	$script = "songFunctions.js";
	$admin = "secretpage"; 
	include("incl/header.php");	
?>

<div id="wrapper">


<div id="mainwrap">
 

	<section id="cont">
	
<h1> Admin song</h1><hr>
<?php
	include("src/validateFunctions.php");
	include("src/databaseFunctions.php");
	include("src/uploadFunctions.php");
	include("src/songFunctions.php");
	
	try
	{
		$dbConnection = myDBConnect();
		//användaren har tryckt på Save
		if(isset($_POST["btnSave"]))
		{
			if(empty($_POST["hidId"]))
			{
				//Insert
				validateSong();
				validateAndMoveUploadedFile("ogg");
				insertSong($dbConnection);
				echo("New song added!");
	
	//Update
			}
			else
			{
				if(!empty($_FILES["fileSoundFileName"]["name"]))
				{
					validateAndMoveUploadedFile("ogg");
				}

				updateSong($dbConnection);
				echo("Song updated!");
			}
		}
		//Delete
		if(isset($_POST["btnDelete"]))
		{
			deleteSong($dbConnection);
			echo("Song deleted!");
		}
		printSongForm($dbConnection);
		listSongs($dbConnection);
		
		myDBClose($dbConnection);

	}
	
		catch(Exception $oException)
{
echo($oException->getMessage());
}

?>
	
	</section>
<!--end cont-->

	<nav id="nav">
	<?php include("incl/adminmenu.php"); ?>


	</nav>
<!--end nav-->

</div>
<!--end mainwrap-->

<?php include ("incl/footer.php"); ?>