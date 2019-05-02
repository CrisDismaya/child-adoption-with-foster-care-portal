<?php
	require("security/common.php");
	if(empty($_SESSION['credenIds']))
	{
		header("Location: login.php");  
		die("Redirecting to login.php");
	}
?>