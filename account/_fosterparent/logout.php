<?php
	require("security/common.php");
	
	unset($_SESSION['credenID']);
	session_destroy();  
	
	header("Location: /PathFinder/account/index.php");
	die("Redirecting to: /PathFinder/account/index"); 
?>