<?php
	require("security/common.php");
	
	unset($_SESSION['credenID']);
	session_destroy();  
	
	header("Location: /Adoption/account/index.php");
	die("Redirecting to: /Adoption/account/index"); 
?>