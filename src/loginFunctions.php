<?php

function validateUser($dbConnection)
{

	$userName = strip_tags($_POST["txtUserName"]);
	$passWord = strip_tags($_POST["txtPassWord"]);
	$userName = mysqli_real_escape_string($dbConnection, $userName);
	$passWord = mysqli_real_escape_string($dbConnection, $passWord);

	$userName=$_POST["txtUserName"];
	$passWord=$_POST["txtPassWord"];
	$isValidUser=0;
	
	//från howto 10
	$strSQL = "SELECT COUNT(*) AS isValidUser FROM tbladmin WHERE ";
	$strSQL .= "username= '$userName' AND ";
	$strSQL .= "password=SHA1('$passWord');";	
	
	$recordSet = myDBQuery($dbConnection, $strSQL);
	
	$record = mysqli_fetch_assoc($recordSet);
	$isValidUser = $record["isValidUser"];
	
	myDBfreeResult($recordSet);
	
	return $isValidUser;
 		
}

function startSession()
{
	session_start();
	session_regenerate_id(true);
	$_SESSION["username"]= $_POST["txtUserName"];
	$_SESSION["online"]= true;
	
}

function endSession()
{
	$_SESSION=array();
	
	if(ini_get("session.use_cookies"))
	{
		$sessionCookieData= session_get_cookie_params();
		$path= $sessionCookieData["path"];
		$domain=$sessionCookieData["domain"];
		$secure=$sessionCookieData["secure"];
		$httponly=$sessionCookieData["httponly"];
		setcookie(session_name(), "", time()-360, $path, $domain, $secure, $httponly);
	}
	session_destroy();
}

function checkSession()
{
	$isOnLine = false;
	session_start();
	
	if(isset($_SESSION["online"])) 
	{
		$isOnLine=true;
		session_regenerate_id(true);
	}
	else
	{
		endSession();
	}
	return $isOnLine;
}