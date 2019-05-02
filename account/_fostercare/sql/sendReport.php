<?php
	if (isset($_POST['srSend'])) {
		include '../../security/connection.php';
		$srCredenId = $_POST['srCredenId'];
		$srName = $_POST['srName'];

		$location = "";
		if(!empty($_FILES['srFile']['tmp_name'])
			&& file_exists($_FILES['srFile']['tmp_name'])) {
			$image = addslashes(file_get_contents($_FILES['srFile']['tmp_name']));
			$image_name = addslashes($_FILES['srFile']['name']);
			move_uploaded_file($_FILES["srFile"]["tmp_name"], "../_dswd/image/Files/" . $_FILES["srFile"]["name"]);
			$location = "../_dswd/image/Files/" . $_FILES["srFile"]["name"];
		}

		$sendQuery = "INSERT INTO reportcare (rcfosterHomeid, rcfilePath, rcfileName, rsTitile)
			VALUES ('$srCredenId', '$location', '$image_name', '$srName')";

		if (!mysqli_query($con, $sendQuery)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('Send Successfully');";
			echo "</script>";
	}
?>