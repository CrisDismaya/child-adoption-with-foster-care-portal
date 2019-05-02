<?php 
	if (isset($_POST['nwSubmit'])) {
		include '../../security/connection.php';

		// $nwCredenId = $_POST['nwCredenId'];

		// $nwPhoto = "";
		// if(!empty($_FILES['nwPhoto']['tmp_name'])
		// 	&& file_exists($_FILES['nwPhoto']['tmp_name'])) {
		// 	$image = addslashes(file_get_contents($_FILES['nwPhoto']['tmp_name']));
		// 	$image_name = addslashes($_FILES['nwPhoto']['name']);
		// 	move_uploaded_file($_FILES["nwPhoto"]["tmp_name"], "image/news/" . $_FILES["nwPhoto"]["name"]);
		// 	$nwPhoto = "image/news/" . $_FILES["nwPhoto"]["name"];
		// }

		// $nwCredenId = $_POST['nwCredenId'];
		// $nwDate = $_POST['nwDate'];
		// $nwTitle = $_POST['nwTitle'];
		// $nwContent = $_POST['nwContent'];

		// $insertQuery = "INSERT INTO news (nwCredenId, nwPath, nwPhoto, nwDate, nwTitle, nwContent) 
		// 	VALUES ('$nwCredenId', '$nwPhoto', '$image_name', '$nwDate', '$nwTitle', '$nwContent')";

		// if (!mysqli_query($con, $insertQuery)) {
		// 	die('Error: ' . mysqli_error($con));
		// }
		// 	echo "<script>";
		// 	echo "alert ('The data has been inserted');";
		// 	echo "</script>";

		$nwCredenId = $_POST['nwCredenId'];
		$nwDate = $_POST['nwDate'];
		$nwTitle = $_POST['nwTitle'];
		$nwContent = $_POST['nwContent'];
		$allow_extension = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
		$extension = pathinfo($_FILES['nwPhoto']['name'], PATHINFO_EXTENSION);
		$video_location = "";
		if ((($_FILES['nwPhoto']['type'] == 'video/mp4') || ($_FILES['nwPhoto']['type'] == 'audio/mp3') || 
				($_FILES['nwPhoto']['type'] == 'audio/wma') || ($_FILES['nwPhoto']['type'] == 'image/jpeg') || 
				($_FILES['nwPhoto']['type'] == 'iamge/gif') || ($_FILES['nwPhoto']['type'] == 'image/png')
				|| ($_FILES['nwPhoto']['type'] == 'image/jpg'))
				&& ($_FILES['nwPhoto']['size'] < 40000000) && in_array($extension, $allow_extension)) {
			if ($_FILES['nwPhoto']['error'] > 0) {
				echo "<script>";
				echo "alert ('".$_FILES['nwPhoto']['error']."');";
				echo "</script>";
			}
			else {
				// echo "UPLOAD : ".$_FILES['nwPhoto']['name']."<br>";
				// echo "TYPE : ".$_FILES['nwPhoto']['type']."<br>";
				// echo "SIZE : ".($_FILES['nwPhoto']['size'] / 1024)."<br>";
				// echo "TENO FILE : ".$_FILES['nwPhoto']['tmp_name']."<br>";

				if (file_exists("videos/" . $_FILES['nwPhoto']['name'])) {
					echo "<script>";
					echo "alert ('".$_FILES['nwPhoto']['name']." already exists');";
					echo "</script>";
				}
				else {
					move_uploaded_file($_FILES['nwPhoto']['tmp_name'], "image/news/".$_FILES['nwPhoto']['name']);
					$image_name = addslashes($_FILES['nwPhoto']['name']);
					$image_location = "image/news/" .  $_FILES["nwPhoto"]["name"];

					$insertQuery = "INSERT INTO news (nwCredenId, nwPath, nwPhoto, nwDate, nwTitle, nwContent) 
						VALUES ('$nwCredenId', '$image_location', '$image_name', '$nwDate', '$nwTitle', '$nwContent')";

					if (!mysqli_query($con, $insertQuery)) {
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
			echo "alert ('Invalid File Size');";
			echo "</script>";
		}

	}

	if (isset($_POST['nwUpdate'])) {
		include '../../security/connection.php';

		$enewsId = $_POST['newsId'];
		
		$enwPhoto = "";
		if(!empty($_FILES['enwPhoto']['tmp_name'])
			&& file_exists($_FILES['enwPhoto']['tmp_name'])) {
			$image = addslashes(file_get_contents($_FILES['enwPhoto']['tmp_name']));
			$eimage_name = addslashes($_FILES['enwPhoto']['name']);
			move_uploaded_file($_FILES["enwPhoto"]["tmp_name"], "image/news/" . $_FILES["enwPhoto"]["name"]);
			$enwPhoto = "image/news/" . $_FILES["enwPhoto"]["name"];
		} 
		else {
			$enwPhoto = $_POST['enwPath'];
		}

		$enwTitle = $_POST['enwTitle'];
		$enwDate = $_POST['enwDate'];
		$newenwDate = date("Y/m/d", strtotime($enwDate));
		$enwContent = $_POST['enwContent'];

		$updateQuery = "UPDATE news SET nwPath = '$enwPhoto', nwPhoto = '$eimage_name', nwDate = '$newenwDate', nwTitle = '$enwTitle', nwContent = '$enwContent' WHERE newsId = '$enewsId'";

		if (!mysqli_query($con, $updateQuery)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('The Data has been Updated');";
			echo "</script>";
	}

	if (isset($_POST['msg_Archive'])) {
		include '../../security/connection.php';

		$anews_id = $_POST['news_id'];

		$updateQuery = "UPDATE news SET nwStatus = 1 WHERE newsId = '$anews_id'";

		if (!mysqli_query($con, $updateQuery)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('News Seccessfully Archived');";
			echo "</script>";
	}
?>