<?php
    require("security/common.php");
   
    if(empty($_SESSION['adminUsers']))
    {
        header("Location: login.php");  
        die("Redirecting to login.php");
    }

?>