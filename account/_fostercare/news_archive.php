<div class="modal fade" id="myArchive<?php echo $row['newsId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<?php 
				include '../../security/connection.php';
				$sqlView = mysqli_query($con, "SELECT * FROM news WHERE newsId = '".$row['newsId']."'");
				$rowView=mysqli_fetch_array($sqlView);

				$newsId = $rowView['newsId'];
				$nwPath = $rowView['nwPath'];

				$nwDate = $rowView['nwDate'];
				$newnwDate = date("m/d/Y", strtotime($nwDate));

				$nwTitle = $rowView['nwTitle'];
				$nwContent = $rowView['nwContent'];
			?>

			<div class="modal-header">
				<?php echo $nwTitle; ?>
			</div>

			<form method="post" action="news_list.php" enctype="multipart/form-data">
				<div class="modal-body">
					<center>
						<input type="hidden" name="news_id" value="<?php echo $newsId; ?>">
						<h3>Are you sure you want to Archive the <br> news of "<b><?php echo $nwTitle; ?></b>"</h3>
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