<?php 
	if (isset($_POST['reportSend'])) {
		include 'security/connection.php';
		$childrenIds = $_POST['childrenIds'];
		$fosterparentIds = $_POST['fosterparentIds'];

		$location = "";
		if(!empty($_FILES['prfile']['tmp_name'])
			&& file_exists($_FILES['prfile']['tmp_name'])) {
			$image = addslashes(file_get_contents($_FILES['prfile']['tmp_name']));
			$image_name = addslashes($_FILES['prfile']['name']);
			move_uploaded_file($_FILES["prfile"]["tmp_name"], "account/_fostercare/image/ParentReport/" . $_FILES["prfile"]["name"]);
			$location = "account/_fostercare/image/ParentReport/" . $_FILES["prfile"]["name"];
		}

		$description = $_POST['description'];

		$parent_report_query = "INSERT INTO parent_report (prFosterparentId, prChildrenId, prPath, prPhotoname, prDescription)
			VALUES ('$fosterparentIds', '$childrenIds', '$location', '$image_name', '$description')";

		if (!mysqli_query($con, $parent_report_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('Send');";
			echo "</script>";
	}
?>