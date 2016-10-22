<?php
	
	define("DB_HOST", "localhost");
	define("DB_USERNAME", "mysqluser");
	define("DB_PASSWORD", "mysqlpassword");
	define("DB", "dbmusic");
	
	function myDBConnect()
	{
		$dbConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB);
		
		if (!$dbConnection) 
		{
			throw new Exception(mysqli_connect_errno().": ".mysqli_connect_error());
		}
		
		return $dbConnection;
	}
	
	function myDBQuery($dbConnection, $strSQL)
	{	
		if(!$recordSet = mysqli_query($dbConnection, $strSQL, MYSQLI_USE_RESULT))
		{
			throw new Exception(mysqli_errno($dbConnection).": ".mysqli_error($dbConnection));
		}
		
		return $recordSet;
		
	}
	
	function myDBFreeResult($recordSet)
	{
		mysqli_free_result($recordSet);
	}

	function myDBClose($dbConnection)
	{
		if(!mysqli_close($dbConnection))
		{
			throw new Exception(mysqli_errno($dbConnection).": ".mysqli_error($dbConnection));
		}
	}