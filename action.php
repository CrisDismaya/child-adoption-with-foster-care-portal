<?php
	include'security/connection.php';
	
	

	if(isset($_POST['res'])){
		$creden_user_id = $_POST['creden_id'];
		$foster_user_id = $_POST['foster_id'];
		$msg_user_content = $_POST['msg_content'];
		$show = mysqli_query($con, "SELECT * FROM message
			JOIN fosterparent ON fosterparent.fosterparentId = message.msgFparentId
			WHERE msgFparentId = '$foster_user_id'  AND msgStatused = '0' GROUP BY messageId");

		while($row = mysqli_fetch_array($show)){
			// echo "<li><b>$row[msgFparentId]</b> : </li>";
			$message_content = $row['msgContent'];
			$message_date = $row['msgCreated'];
			$newmessage_date = date("m/d/Y h:i A", strtotime($message_date));

			$pic = "";
			if ($row['msgSendid'] == $foster_user_id) {
				$pic = 'account/_fostercare/'.$row['fpPtoho'];
			} else {
				$pic = "images/orphanage.png";
			}

			echo '
			<li class="left clearfix">
				<span class="chat-img1 pull-left">
					<img src="'.$pic.'" alt="User Avatar" class="img-circle">
				</span>

				<div class="chat-body1 clearfix">
					<p>'. $message_content .'</p>
					<div class="chat_time pull-right">'. $newmessage_date .'</div>
				</div>
			</li>

			
			';
		}
	} 

	if (isset($_POST['message_user'])) {
		$creden_user = $_POST['creden_user'];
		$foster_user = $_POST['foster_user'];
		$message_user = $_POST['message_user'];

		mysqli_query($con, "INSERT INTO message (msgCredenId, msgFparentId, msgSendid, msgContent, msgArchive)
				VALUES ('$creden_user', '$foster_user', '$foster_user', '$message_user', '1')");
	}
	
	

?>
<!-- <li class="left clearfix admin_chat">
				<span class="chat-img1 pull-right">
					<img src="images/profile.png" alt="User Avatar" class="img-circle">
				</span>
				<div class="chat-body1 clearfix">
					<p>'. $message_content .'</p>
					<div class="chat_time pull-left">'. $newmessage_date .'</div>
				</div>
			</li> -->