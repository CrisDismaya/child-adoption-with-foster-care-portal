<div class="modal fade" id="myArchive<?php echo $row['messageId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<?php 
				include '../../security/connection.php';
				$sqlView = mysqli_query($con, "SELECT * FROM fosterparent 
					JOIN message ON fosterparent.fosterparentId = message.msgFparentId
					WHERE messageId = '".$row['messageId']."'");
				$rowView=mysqli_fetch_array($sqlView);
				$parentId = $rowView['fosterparentId'];
				$messageId = $rowView['messageId'];
				$message_msgID = $rowView['msgFparentId'];
				$fosterParent = $rowView['fpFname']." ".$rowView['fpMname']." ".$rowView['fpLname'];
			?>

			<div class="modal-header">
				<?php echo $fosterParent; ?>
			</div>
			<form method="post" action="sql/message.php" enctype="multipart/form-data">
				<div class="modal-body">
					<center>
						<input type="hidden" name="messageId" value="<?php echo $messageId; ?>">
						<input type="hidden" name="parentId" value="<?php echo $parentId; ?>">
						<input type="hidden" name="message_msgID" value="<?php echo $message_msgID; ?>">
						<h3>Are you sure you want to Archive the <br> message of "<b><?php echo $fosterParent; ?></b>"</h3>
					</center>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="msg_Archive" class="btn btn-primary">Yes</button>
				</div>
			</form>

		</div>
	</div>
</div>