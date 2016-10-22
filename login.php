<?php
	include("src/loginFunctions.php");
	
	if(checkSession())
	{
		header("location: adminArtist.php");
 		exit();
	}
	
	if(isset($_POST["btnLogin"]))
	{
		include("src/databaseFunctions.php");
	
		try
		{
			$dbConnection = myDBConnect();
			
			if(validateUser($dbConnection) == 1)
			{
				startSession();
				header("location: adminArtist.php");
				exit();
			}
			else
			{
				throw new Exception("Du har angivit ett felaktigt användarnamn/lösenord");
			}
			
			myDBConnect($dbConnection);
		}
		catch(Exception $oException)
		{
			$errorMessage = $oException->getMessage();
		}
	}

	include("incl/debug.php");
	$title = "MusicSite/Login";
	$script = "";
	include("incl/header.php");
?>

<div id="wrapper">


<div id="mainwrap">
 

	<section id="cont">
<h1>Login</h1>	
<hr>
<?php 	
	if(isset($errorMessage))
	{
	echo($errorMessage);
	}
 ?>
 
<FIELDSET>
<LEGEND><b>Login</b></LEGEND>
	<form action="login.php" method="post" enctype="multipart/form-data" name="frmLogin"> 
	<p>
	<label>Username:</label><br/>
	<input type="search" name="txtUserName" id="txtUserName" autofocus="autofocus" required="required" title="Username" size="35" placeholder="Type your username here"/><br/>
	<label>Password:</label><br/>
	<input type="password" name="txtPassWord" id="txtPassWord" autofocus="autofocus" required="required" title="Password" size="35" placeholder="Type your password here"/>
	
	</p>
	<br/>
	<input type="submit" name="btnLogin" id="btnLogin" value="Login"/>
	<input type="reset" name="btnReset" id="btnReset" value="Reset" />

	</form></FIELDSET>

	</section>
<!--end cont-->

	<nav id="nav">
	<?php include("incl/contentmenu.php"); ?>


	</nav>
<!--end nav-->

</div>
<!--end mainwrap-->

<?php include ("incl/footer.php"); ?>