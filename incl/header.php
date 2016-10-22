<?php
	if(isset($admin) && $admin == "secretpage")
	{
		include ("src/loginFunctions.php");
	
		if(!checkSession())
		{
			header("location: login.php");
			exit();
		}
	}


?>
<!DOCTYPE HTML>
<html lang="sv">

	<head>
		<title><?php echo($title); ?></title>
		<script src="script/<?php echo($script); ?>" type="text/javascript"></script>


		<meta charset="utf-8">
		<link href="style/stilmall.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<header id="siteheader">
		<h1>MusicSite</h1>
		</header>
		
		<header id="menuheader">
		<ul> 
		
		<li> <a href="#">About MusicSite</a> </li>
		<li> <a href="#">Artists stored</a> </li>
		<li> <a href="#">Songs stored</a> </li>

		</ul>
		</header>
