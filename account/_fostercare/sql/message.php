<?php
	if (isset($_POST['msgSend'])) {
		include '../../security/connection.php';

		$credenId = $_POST['credenId'];
		$msgFparentId = $_POST['msgFparentId'];
		$msgContent = $_POST['msgContent'];

		$send = "INSERT INTO message (msgCredenId, msgFparentId, msgSendid, msgContent, msgArchive)
			VALUES ('$credenId', '$msgFparentId', '$credenId', '$msgContent', '1')";

		if (!mysqli_query($con, $send)) {
			die('Error: ' . mysqli_error($con));
		}
			$msg = mysqli_query($con, "UPDATE fosterparent SET msgStatus = 1 WHERE fosterparentId = '$msgFparentId'");

			echo "<script>";
			echo "alert ('Message has been send');";
			echo "</script>";
	}
	
	if (isset($_POST['msg_Archive'])) {
		include '../../security/connection.php';
		$messageId = $_POST['messageId'];
		$parentId = $_POST['parentId'];
		$message_msgID = $_POST['message_msgID'];

		$archive = "UPDATE message SET msgArchive = 2, msgStatused = 1 WHERE msgFparentId = '$message_msgID'";
		
		if (!mysqli_query($con, $archive)) {
			die('Error: ' . mysqli_error($con));
		}
			$fparent_msg = mysqli_query($con, "UPDATE fosterparent SET msgStatus = 0 WHERE fosterparentId = '$parentId'");
			header("Location: ../message_view.php");
			echo "<script>";
			echo "alert ('Archive Successfully');";
			echo "</script>";
	}

	// if (isset($_POST['send_message'])) {
	// 	include '../../security/connection.php';
	// 	$credenIds = $_POST['credenIds'];
	// 	$messageIds = $_POST['messageIds'];
	// 	$msgContents = $_POST['msgContents'];

	// 	$messge_send = "INSERT INTO message (msgCredenId, msgFparentId, msgContent, msgArchive)
	// 		VALUES ('$credenIds', '$messageIds', '$msgContents', '1')";

	// 	if (!mysqli_query($con, $messge_send)) {
	// 		die('Error: ' . mysqli_error($con));
	// 	}
	// 		echo "<script>";
	// 		echo "alert ('Messge Send');";
	// 		echo "</script>";
	// }
?>