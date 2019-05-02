<?php
	if (isset($_POST['FHSubmit'])) {
		include '../../security/connection.php';
		$FHName = $_POST['FHName'];
		$FHAddress = $_POST['FHAddress'];
		$FHDistrict = $_POST['FHDistrict'];

		$varMunicipal = "";
		$FHMunicpal = $_POST['FHMunicpal'];
		$getMunicipal = "SELECT * FROM municipal WHERE muniPostal = '$FHMunicpal'";
		$disMunicipal = $con->query($getMunicipal);   
			if ($disMunicipal->num_rows > 0) {
				while($row = $disMunicipal->fetch_assoc()) {
					$varMunicipal = $row['muniId'];
				}
			}

		$FHEmail = $_POST['FHEmail'];
		$FHContact = $_POST['FHContact'];
		$FHUsername = $_POST['FHUsername'];
		$FHPassword = $_POST['FHPassword'];
		$hashed_password = password_hash($FHPassword, PASSWORD_DEFAULT);

		$query = "INSERT INTO fosterhome (fhName, fhAddress, FHDistrict, fhMunicipal, fmEmail,fhContact, fhUsername, fhPassword, fhStatus) 
			VALUES ('$FHName', '$FHAddress', '$FHDistrict', '$varMunicipal', '$FHEmail', '$FHContact', '$FHUsername', '$hashed_password', 2)";

		if (!mysqli_query($con, $query)) {
			die('Error: ' . mysqli_error($con));
		}
			$fosterhomeId =  mysqli_insert_id($con);
			$creden ="INSERT INTO credentials (credenAnyid, credenUser, credenPass, credenLevel)
				VALUES ('$fosterhomeId', '$FHUsername', '$hashed_password', 2)";
			mysqli_query($con, $creden);
			// echo "<script>";
			// echo "swal ('The data has been inserted');";
			// echo "</script>";

			echo "<script>";
			echo "alert ('The data has been inserted');";
			echo "</script>";
	}
?>