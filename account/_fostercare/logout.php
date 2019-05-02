<?php
	require("security/common.php");
	
	unset($_SESSION['credenID']);
	session_destroy();  
	
	header("Location: /account/index.php");
	die("Redirecting to: /account/index"); 
?>