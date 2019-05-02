<?php 
	if (isset($_POST['send_message'])) {
		include '../../security/connection.php';

		$msg_creden_id = $_POST['msg_creden_id'];
		$msg_fosterparent_id = $_POST['msg_fosterparent_id'];
		$message_content = $_POST['message_content'];

		$msg_send = "INSERT INTO message (msgCredenId, msgFparentId, msgContent, msgArchive)
			VALUES ('$msg_creden_id', '$msg_fosterparent_id', '$message_content', '1')";

		if (!mysqli_query($con, $msg_send)) {
			die('Error: ' . mysqli_error($con));
		}	
			$msg = mysqli_query($con, "UPDATE fosterparent SET msgStatus = 1 WHERE fosterparentId = '$msg_fosterparent_id'");

			header("Location: reviewReports_list.php");
			echo "<script>";
			echo "alert ('Message has been sent');";
			echo "</script>";
	}
?>