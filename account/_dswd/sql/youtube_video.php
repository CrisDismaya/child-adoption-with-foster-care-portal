<?php
	if (isset($_POST['save_links'])) {
		include '../../security/connection.php';

		$y_links = $_POST['y_links'];
		$y_title = $_POST['y_title'];
		$upload_query = "INSERT INTO y_video (y_video_link, y_video_title) VALUES ('$y_links', '$y_title')";
		if (!mysqli_query($con, $upload_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('File has been uploaded');";
			echo "</script>";
	}

	if(isset($_POST['video_archive_yes'])){
		include '../../security/connection.php';
		$video_id = $_POST['video_id'];
		$upload_query = "UPDATE y_video SET y_archive = 1 WHERE y_video_id = '$video_id'";
		if (!mysqli_query($con, $upload_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('Successfuly');";
			echo "</script>";
	}
?>