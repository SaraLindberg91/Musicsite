<?php
	include("incl/debug.php");
	$title = "MusicSite/AddComment";
	$script = "";
	include("incl/header.php");
	
?>
<div id="wrapper">

<div id="mainwrap">
 
	<section id="cont">
	<h1>Comment song</h1>
<?php
	include("src/databaseFunctions.php");
	include("src/searchFunctions.php");
	
	try
 	{
		$dbConnection = myDBConnect();
		printCommentForm($dbConnection);
 		if(isset($_GET["id"]))
	 	{
			listComments($dbConnection);
		}
		if(isset($_POST["btnSave"]))
		{ 
			insertComment($dbConnection);
			listComments($dbConnection);
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