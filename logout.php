<?php
	require("security/common.php");
	
	unset($_SESSION['credenID']);
	session_destroy();  
	
	header("Location: index.php");
	die("Redirecting to: index"); 
?>