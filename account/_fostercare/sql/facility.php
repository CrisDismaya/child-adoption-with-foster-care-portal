<?php
	if (isset($_POST['faSubmit'])) {
		include '../../security/connection.php';

		$faCredenId = $_POST['faCredenId'];
		$faName = $_POST['faName'];
		$allow_extension = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
		$extension = pathinfo($_FILES['faPhoto']['name'], PATHINFO_EXTENSION);
		$video_location = "";
		if ((($_FILES['faPhoto']['type'] == 'video/mp4') || ($_FILES['faPhoto']['type'] == 'audio/mp3') || 
				($_FILES['faPhoto']['type'] == 'audio/wma') || ($_FILES['faPhoto']['type'] == 'image/jpeg') || 
				($_FILES['faPhoto']['type'] == 'iamge/gif') || ($_FILES['faPhoto']['type'] == 'image/png') || 
				($_FILES['faPhoto']['type'] == 'image/jpg') || ($_FILES['faPhoto']['type'] == 'image/JPG')) 
				&& ($_FILES['faPhoto']['size'] < 40000000) && in_array($extension, $allow_extension)) {
			if ($_FILES['faPhoto']['error'] > 0) {
				echo "<script>";
				echo "alert ('".$_FILES['faPhoto']['error']."');";
				echo "</script>";
			}
			else {
				// echo "UPLOAD : ".$_FILES['faPhoto']['name']."<br>";
				// echo "TYPE : ".$_FILES['faPhoto']['type']."<br>";
				// echo "SIZE : ".($_FILES['faPhoto']['size'] / 1024)."<br>";
				// echo "TENO FILE : ".$_FILES['faPhoto']['tmp_name']."<br>";

				if (file_exists("videos/" . $_FILES['faPhoto']['name'])) {
					echo "<script>";
					echo "alert ('".$_FILES['faPhoto']['name']." already exists');";
					echo "</script>";
				}
				else {
					move_uploaded_file($_FILES['faPhoto']['tmp_name'], "image/Facility/".$_FILES['faPhoto']['name']);
					$video_name = addslashes($_FILES['faPhoto']['name']);
					$image_location = "image/Facility/" .  $_FILES["faPhoto"]["name"];

					$query = "INSERT INTO facility (faCredenId, faPhoto, faName, faStatus) VALUES ('$faCredenId', '$image_location', '$faName', '1')";
					if (!mysqli_query($con, $query)) {
						die('Error: ' . mysqli_error($con));
					}
						echo "<script>";
						echo "alert ('The data has been inserted');";
						echo "</script>";
				}
			}
		}
		else{
			echo "<script>";
			echo "alert ('Invalid File ');";
			echo "</script>";
		}
	}

	if (isset($_POST['faArchive'])) {
		include '../../security/connection.php';
		$afacilityId = $_POST['afacilityId'];

		$archive = "UPDATE facility SET faStatus = 2 WHERE facilityId = '$afacilityId'";

		if (!mysqli_query($con, $archive)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('Archive Successfully');";
			echo "</script>";
	}
?>