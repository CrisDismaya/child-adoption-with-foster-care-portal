<?php
	if (isset($_POST['fpSubmit'])) {
		include '../../security/connection.php';
		$credenId = $_POST['credenId'];
		$fosterhomeId = $_POST['fosterhomeId'];
		$location = "";
		if(!empty($_FILES['fpPhoto']['tmp_name'])
			&& file_exists($_FILES['fpPhoto']['tmp_name'])) {
			$image = addslashes(file_get_contents($_FILES['fpPhoto']['tmp_name']));
			$image_name = addslashes($_FILES['fpPhoto']['name']);
			move_uploaded_file($_FILES["fpPhoto"]["tmp_name"], "image/FosterParent/" . $_FILES["fpPhoto"]["name"]);
			$location = "image/FosterParent/" . $_FILES["fpPhoto"]["name"];
		}

		$fpFname = $_POST['fpFname'];
		$fpMname = $_POST['fpMname'];
		$fpLname = $_POST['fpLname'];
		$fpAge = $_POST['fpAge'];
		$fpBirthday = $_POST['fpBirthday'];
		$fpGender = $_POST['fpGender'];
		$fpCivilStatus = $_POST['fpCivilStatus'];
		$fpContact = $_POST['fpContact'];
		$fpEmail = $_POST['fpEmail'];
		$fpAddress = $_POST['fpAddress'];

		$handerChildren_name = $handerChildren_bday = "";
		$fpChild = $_POST['fpChild'];
		$getMunicipal = "SELECT * FROM children WHERE childrenId = '$fpChild'";
		$disMunicipal = $con->query($getMunicipal);   
		if ($disMunicipal->num_rows > 0) {
			while($row = $disMunicipal->fetch_assoc()) {
				$handerChildren_name = $row['chFname']." ".$row['chMname']." ".$row['chLname'];
				$handerChildren_bday = $row['chBirthday'];
			}
		}

		$fpStatusAdopt = $_POST['fpStatusAdopt'];
		$fpUsername = $_POST['fpUsername'];
		$fpPassword = $_POST['fpPassword'];
		$hashed_password = password_hash($fpPassword, PASSWORD_DEFAULT);

		$query = "INSERT INTO fosterparent (fpCreadenId, fpFosterparentId, fpPtoho, fpFname, fpMname, fpLname, fpAge, fpBirthday, fpGender, fpCivilStatus, fpContact, fpEmail, fpAddress, fpChild, fpStatusAdopt, fpUsername, fpPassword, fpStatus, fpAccountStatus)
			VALUES ('$credenId', '$fosterhomeId', '$location', '$fpFname ', '$fpMname', '$fpLname', '$fpAge', '$fpBirthday', '$fpGender', '$fpCivilStatus', '$fpContact', '$fpEmail', '$fpAddress', '$fpChild', '$fpStatusAdopt', '$fpUsername', '$hashed_password', '3', '0')";


		if (!mysqli_query($con, $query)) {
			die('Error: ' . mysqli_error($con));
		}
			$fosterhparentId =  mysqli_insert_id($con);
			$creden ="INSERT INTO credentials (	credenAnyid, credenUser, credenPass, credenLevel)
				VALUES ('$fosterhparentId', '$fpUsername', '$hashed_password', '3')";
			mysqli_query($con, $creden);

			$children_adopt_table = "INSERT INTO children_adopt_by_parent (adopt_parent_id, adopt_children_id, adopt_children_name, adopt_children_bday, adopt_children_status) 
				VALUES ('$fosterhparentId', '$fpChild', '$handerChildren_name', '$handerChildren_bday', '$fpStatusAdopt')";
			mysqli_query($con, $children_adopt_table);

			$children_adopt = "UPDATE children SET chStatus = '$fpStatusAdopt', chChildAdopt = '$fpStatusAdopt' 
				WHERE childrenId = '$fpChild'";
			mysqli_query($con, $children_adopt);


			echo "<script>";
			echo "alert ('The data has been inserted');";
			echo "</script>";
	}

	if (isset($_POST['fpUpdate'])) {
		include '../../security/connection.php';

		$efosterparentId = $_POST['efosterparentId'];
		$elocation = "";
		if(!empty($_FILES['efpPhoto']['tmp_name'])
			&& file_exists($_FILES['efpPhoto']['tmp_name'])) {
			$image = addslashes(file_get_contents($_FILES['efpPhoto']['tmp_name']));
			$image_name = addslashes($_FILES['efpPhoto']['name']);
			move_uploaded_file($_FILES["efpPhoto"]["tmp_name"], "image/FosterParent/" . $_FILES["efpPhoto"]["name"]);
			$elocation = "image/FosterParent/" . $_FILES["efpPhoto"]["name"];
		} else {
			$elocation = $_POST['efp_photo'];
		}

		$efpFname = $_POST['efpFname'];
		$efpMname = $_POST['efpMname'];
		$efpLname = $_POST['efpLname'];
		$efpAge = $_POST['efpAge'];

		$efpBirthday = $_POST['efpBirthday'];
		$newefpBirthday = date("Y-m-d", strtotime($efpBirthday));

		$efpGender = "";
		if ($_POST['efpGender'] = 1) {
			$efpGender = 1; } 
		else {
			$efpGender = 2; }

		$efpContact = $_POST['efpContact'];
		$efpEmail = $_POST['efpEmail'];
		$efpAddress = $_POST['efpAddress'];
		$efpChild = $_POST['efpChild'];
		// $efpStatusAdopt = $_POST['efpStatusAdopt'];
		$efpAccountStatus = $_POST['efpAccountStatus'];
		$efpUsername = $_POST['efpUsername'];

		$hander_Child_name = $hander_Child_bday = "";
		$Children_id_add = $_POST['Children_id_add'];
		$child_query = "SELECT * FROM children WHERE childrenId = '$Children_id_add'";
		$child_display = $con->query($child_query);   
		if ($child_display->num_rows > 0) {
			while($child_row = $child_display->fetch_assoc()) {
				$hander_Child_name = $child_row['chFname']." ".$child_row['chMname']." ".$child_row['chLname'];
				$hander_Child_bday = $child_row['chBirthday'];
			}
		}
		$children_status_id_add = $_POST['children_status_id_add'];

		$Children_id_udpate = $_POST['Children_id_udpate'];

		// foreach (($_POST['Children_id']) as $Children_ids){
		// 	$children_query = mysqli_query($con,"SELECT childrenId, chFname, chMname, chLname, chBirthday FROM children WHERE childrenId = '$Children_ids'");
		// 	$children_rows=mysqli_fetch_array($children_query);
		// 	$ChildrenId = $children_rows['childrenId'];
		// 	$ChildrenName = $children_rows['chFname']." ".$children_rows['chMname']." ".$children_rows['chLname'];
		// 	$ChildrenBday = $children_rows['chBirthday'];
			
		// 	$adopt_query = "INSERT INTO children_adopt_by_parent (adopt_parent_id, adopt_children_id, adopt_children_name, adopt_children_bday, adopt_children_status)  VALUES ('$efosterparentId', '$ChildrenId', '$ChildrenName', '$ChildrenBday', '$children_status_id')";
		// 	mysqli_query($con, $adopt_query);

		// 	$children_status = "UPDATE children SET chStatus = '$efpStatusAdopt', chChildAdopt = '$efpStatusAdopt' 
		// 		WHERE childrenId = '$Children_ids'";
		// 	mysqli_query($con, $children_status);	
		// }

		if (!empty($Children_id_add)) {
			$adopt_query_save = "INSERT INTO children_adopt_by_parent (adopt_parent_id, adopt_children_id, adopt_children_name, adopt_children_bday, adopt_children_status)  
				VALUES ('$efosterparentId', '$Children_id_add', '$hander_Child_name', '$hander_Child_bday', '$children_status_id_add')";
			mysqli_query($con, $adopt_query_save);

			$children_adopt_update = "UPDATE children SET chStatus = '$children_status_id_add', chChildAdopt = '$children_status_id_add' 
				WHERE childrenId = '$Children_id_add'";
			mysqli_query($con, $children_adopt_update);
		}

		$update = "UPDATE fosterparent SET fpPtoho = '$elocation', fpFname = '$efpFname', fpMname = '$efpMname', fpLname = '$efpLname',
			fpAge = '$efpAge', fpBirthday = '$newefpBirthday', fpGender = '$efpGender', fpContact = '$efpContact', fpEmail = '$efpEmail', 
			fpAddress = '$efpAddress', fpChild = '$efpChild', fpAccountStatus = '$efpAccountStatus'
			WHERE fosterparentId = '$efosterparentId'";

		if (!mysqli_query($con,$update)) {
			die('Error: ' . mysqli_error($con));
		}

			// $adopt_query_udpate = "UPDATE children_adopt_by_parent SET adopt_children_status = '$efpStatusAdopt' 
			// 	WHERE adopt_children_id = '$Children_id_udpate'";
			// mysqli_query($con, $adopt_query_udpate);

			// $child_query_udpate = "UPDATE children SET chStatus = '$efpStatusAdopt', chChildAdopt = '$efpStatusAdopt'
			// 	WHERE childrenId = '$Children_id_udpate'";
			// mysqli_query($con, $child_query_udpate);

			
			$crendentials_update = "UPDATE credentials SET crendeStatus = '$efpAccountStatus' WHERE credenUser = '$efpUsername'";
			mysqli_query($con, $crendentials_update);
					
			echo "<script>";
			echo "alert ('The data has been updated');";
			echo "</script>";
	}
?>