<div class="modal fade" id="myMessage<?php echo $foster_parent_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php 
				include '../../security/connection.php';
				$credenIds = $_SESSION['credenId'];
				$sqlDisplpay_fosterparent = mysqli_query($con, "SELECT * FROM fosterparent 
					WHERE fosterparentId = '".$foster_parent_id."'");
				$dis_fp = mysqli_fetch_array($sqlDisplpay_fosterparent);

				$msg_foster_parent_id = $dis_fp['fosterparentId'];
				$msg_foster_parent_name = $dis_fp['fpFname']." ".$dis_fp['fpMname']." ".$dis_fp['fpLname'];	
			?>
			<form method="post" action="reviewReports_Details.php" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="container-fluid">
						<span><b>TO : </b><i><?php echo $msg_foster_parent_name; ?></i></span><br><br>
						<input type="hidden" name="msg_creden_id" value="<?php echo $credenIds; ?>"><br>
						<input type="hidden" name="msg_fosterparent_id" value="<?php echo $msg_foster_parent_id; ?>">
						<textarea name="message_content" class="form-control" rows="5" placeholder="Message Content" required style="resize: none;"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="send_message" id="send_message" class="btn btn-primary pull-right">
						Send
					</button>
				</div>
			</form>
		</div>
	</div>
</div>