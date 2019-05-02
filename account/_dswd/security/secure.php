<?php
    require("common.php");
   
    if(empty($_SESSION['credenId']))
    {
        header("Location: ../index.php");  
        die("Redirecting to ../index.php");
    }
?>