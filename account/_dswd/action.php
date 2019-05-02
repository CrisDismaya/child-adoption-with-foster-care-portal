<?php
	include '../../security/connection.php';

	if(isset($_POST["disId"]) && !empty($_POST["disId"])){
	    //Get all state data
	    $query = mysqli_query($con, "SELECT * FROM municipal WHERE disId = '".$_POST['disId']."'");
	    
	    //Count total number of rows
	    $rowCount = $query->num_rows;
	    
	    //Display states list
	    if($rowCount > 0){
	        echo '<option hidden>Select Municipal</option>';
	        while($row = $query->fetch_assoc()){ 
	            echo '<option value="'.$row['muniPostal'].'">'.$row['muniName'].'</option>';
	        }
	    }else{
	        echo '<option value="">State not available</option>';
	    }
	}
?>