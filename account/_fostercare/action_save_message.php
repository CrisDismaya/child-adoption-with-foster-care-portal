<?php
	include'../../security/connection.php';

	if (isset($_POST['msg_Contents'])) {
		$creden_Id = $_POST['creden_Id'];
		$message_Id = $_POST['message_Id'];
		$msg_Contents = $_POST['msg_Contents'];

		mysqli_query($con, "INSERT INTO message (msgCredenId, msgFparentId, msgSendid, msgContent, msgArchive)
				VALUES ('$creden_Id', '$message_Id', '$creden_Id', '$msg_Contents', '1')");
	}
?>