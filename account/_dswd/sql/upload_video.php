<?php
	if (isset($_POST['btn_upload'])) {
		include '../../security/connection.php';

		$video_title = $_POST['video_title'];
		$allow_extension = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
		$extension = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);
		$video_location = "";
		if ((($_FILES['video_file']['type'] == 'video/mp4') || ($_FILES['video_file']['type'] == 'audio/mp3') || 
				($_FILES['video_file']['type'] == 'audio/wma') || ($_FILES['video_file']['type'] == 'image/jpeg') || 
				($_FILES['video_file']['type'] == 'iamge/gif') || ($_FILES['video_file']['type'] == 'image/png'))
				&& ($_FILES['video_file']['size'] < 10000000) && in_array($extension, $allow_extension)) {
			if ($_FILES['video_file']['error'] > 0) {
				echo "<script>";
				echo "alert ('".$_FILES['video_file']['error']."');";
				echo "</script>";
			}
			else {
				// echo "UPLOAD : ".$_FILES['video_file']['name']."<br>";
				// echo "TYPE : ".$_FILES['video_file']['type']."<br>";
				// echo "SIZE : ".($_FILES['video_file']['size'] / 1024)."<br>";
				// echo "TENO FILE : ".$_FILES['video_file']['tmp_name']."<br>";

				if (file_exists("videos/" . $_FILES['video_file']['name'])) {
					echo "<script>";
					echo "alert ('".$_FILES['video_file']['name']." already exists');";
					echo "</script>";
				}
				else {
					move_uploaded_file($_FILES['video_file']['tmp_name'], "videos/".$_FILES['video_file']['name']);
					$video_name = addslashes($_FILES['video_file']['name']);
					$video_location = "videos/" .  $_FILES["video_file"]["name"];

					$upload_query = "INSERT INTO video (video_path, video_name, video_title) 
						VALUES ('$video_location', '$video_name', '$video_title')";
					if (!mysqli_query($con, $upload_query)) {
						die('Error: ' . mysqli_error($con));
					}
						echo "<script>";
						echo "alert ('File has been uploaded');";
						echo "</script>";
				}
			}
		}
		else{
			echo "<script>";
			echo "alert ('.JPG Invalid File ');";
			echo "</script>";
		}
	}
?>
