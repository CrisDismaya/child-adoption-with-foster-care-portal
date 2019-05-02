<?php
	if (isset($_POST['dl_save'])) {
		include '../../security/connection.php';

		$file_path = "";
		if(!empty($_FILES['download_file']['tmp_name'])
			&& file_exists($_FILES['download_file']['tmp_name'])) {
			$file = addslashes(file_get_contents($_FILES['download_file']['tmp_name']));
			$file_name = addslashes($_FILES['download_file']['name']);
			move_uploaded_file($_FILES["download_file"]["tmp_name"], "download_files/" . $_FILES["download_file"]["name"]);
			$file_path = "download_files/" . $_FILES["download_file"]["name"];
		}

		$save_query = "INSERT INTO download_file (dl_path, dl_filename) VALUES ('$file_path', '$file_name')";

		if (!mysqli_query($con, $save_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('File has been uploaded');";
			echo "</script>";
	}

	if (isset($_POST['dl_archive_yes'])) {
		include '../../security/connection.php';

		$dis_download_id = $_POST['dis_download_id'];

		$update_query = "UPDATE download_file SET dl_file_status = 1 WHERE download_id = '$dis_download_id'";

		if (!mysqli_query($con, $update_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('Archive Successfully');";
			echo "</script>";
	}
?>