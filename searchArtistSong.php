<?php
include("incl/debug.php");
$title = "MusicSite/Search artist/song";
$script = "";
include ("incl/header.php");
?>
<div id="wrapper">


<div id="mainwrap">

	<section id="cont">
<h1> Search artist and/or song</h1>
<hr>
<?php
 	include("src/databaseFunctions.php");
 	include("src/searchFunctions.php");
 try
 {
	$dbConnection = myDBConnect();
	printSongForm();
	 	
	if(isset($_POST["btnSubmit"]))
 	{		
 		listArtists($dbConnection);
 		listSongs($dbConnection);
 
 	}

 	if(isset($_GET["id"]))
 	{
 		likeSong($dbConnection);
		listArtists($dbConnection);
 		listSongs($dbConnection);
 	}
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
	<?php include("incl/contentmenu.php"); ?>


	</nav>
<!--end nav-->

</div>
<!--end mainwrap-->

<?php include ("incl/footer.php"); ?>