<div class="modal fade" id="dl_archive<?php echo $download_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php
				include '../../security/connection.php';
				$dl_archive_query = mysqli_query($con, "SELECT * FROM download_file WHERE download_id = '".$download_id."'");
				$archive_display = mysqli_fetch_array($dl_archive_query);
				$dis_download_id = $archive_display['download_id'];
				$dis_dl_path = $archive_display['dl_path'];
				$dis_dl_filename = $archive_display['dl_filename'];
			?>
			<form method="post" action="download_file.php" enctype="multipart/form-data">
				<div class="modal-body">
					<center>
						<h3>Are you sure you want to archive file <br><b>"<?php echo $dis_dl_filename; ?>"</b></h3><br>
						<input type="hidden" name="dis_download_id" value="<?php echo $dis_download_id; ?>">
					</center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="dl_archive_yes" class="btn btn-primary">Yes</button>
				</div>
			</form>
		</div>
	</div>
</div>