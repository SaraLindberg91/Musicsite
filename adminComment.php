<?php
	include("incl/debug.php");
	$title = "MusicSite/adminComment";
	$script = "commentFunctions.js";
	$admin = "secretpage"; 
	include("incl/header.php");
	
?>
<div id="wrapper">


<div id="mainwrap">
 

	<section id="cont">
	
<h1> Admin Comment</h1>
	
<?php

	include("src/databaseFunctions.php");
	include("src/commentFunctions.php");
try
{
	$dbConnection = myDBConnect();
	if(isset($_POST["btnDelete"]))
	{
		deleteComment($dbConnection);
		echo("Comment deleted!");
	}
	
	listComments($dbConnection);
	
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