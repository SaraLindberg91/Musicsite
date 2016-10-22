<?php
	include("src/loginFunctions.php");
	
	if(checkSession())
	{
		endSession();
	}
	else
	{
		header("location: login.php");
		exit();
	}
	
	include("incl/debug.php");
	$title="MusicSite/Logout";
	$script="";
	include("incl/header.php");

?>
<div id="wrapper">


<div id="mainwrap">
 

	<section id="cont">
	<h1> You are no longer logged on!</h1>
	<p>
	Have a nice day!
	</p>

	</section>
<!--end cont-->

	<nav id="nav">
	<?php include("incl/contentmenu.php"); ?>


	</nav>
<!--end nav-->

</div>
<!--end mainwrap-->

<?php include ("incl/footer.php"); ?>