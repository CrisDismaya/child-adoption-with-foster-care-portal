<?php 
	if (isset($_POST['signin'])) {
		include 'security/connection.php';
    	require 'security/common.php';
    	$user = $_POST['username'];
    	$pass =  $_POST['password'];

    	$sql = "SELECT * FROM credentials 
            JOIN fosterparent ON credentials.credenUser = fosterparent.fpUsername
            WHERE fpUsername = '$user' AND fpAccountStatus = 0";
    	$result = $con->query($sql);

    	if($result->num_rows > 0){
    		while($row= $result->fetch_assoc()){
    			if(password_verify($pass, $row['credenPass'])){
                
    				$_SESSION['credenIds'] = $row['credenId'];
    				$_SESSION['credenUsers'] = $row['credenUser'];	
    				$_SESSION['credenLevels'] = $row['credenLevel'];  

                    if ($_SESSION['credenLevels'] == 3) {
                        header("Location: home.php");
                        die("Redirecting to: home"); } 
                    else { 
                        echo " <script> alert ('Noted'); </script> ";
                    }
    			} else {
                     echo " <script> alert ('Invalid Username and Password'); </script> ";
                }
    		} 
    	} else {
            echo " <script> alert ('Invalid Username and Password'); </script> ";
        }
    	$con->close();
	}
?>