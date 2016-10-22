<?php
	include("incl/debug.php");
	$title = "MusicSite/AdminArtist";
	$script= "artistFunctions.js";
	$admin = "secretpage"; 
	//flaggar för att det behövs ett påloggningsförfarande för denna sida	
	
	include("incl/header.php");
?>

<div id="wrapper">


<div id="mainwrap">
 
	<section id="cont">
	
<h1> Admin artist</h1>
	
	
	<?php
	include("src/validateFunctions.php");
	include("src/databaseFunctions.php");
	include("src/uploadFunctions.php");
	include("src/artistFunctions.php");
	
	try
	{
		$dbConnection = myDBConnect();
		//användaren har tryckt på Save
		if(isset($_POST["btnSave"]))
		{ 
		//Insert
			if(empty($_POST["hidId"]))
			{
				insertArtist($dbConnection);
				validateArtist();
				validateAndMoveUploadedFile("jpg");
				echo("New artist added!");
			}

	//Update
			else
			{
			
				if(!empty($_FILES["filePictureFileName"]["name"]))
				{
					validateAndMoveUploadedFile("jpg");
				}
				updateArtist($dbConnection);
			
				echo("Artist updated!");
				
			}
		}
		//Delete
		if(isset($_POST["btnDelete"]))
		{
			deleteArtist($dbConnection);
			echo("Artist deleted!");
	
		}
		printArtistForm($dbConnection);
		listArtists($dbConnection);
	

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