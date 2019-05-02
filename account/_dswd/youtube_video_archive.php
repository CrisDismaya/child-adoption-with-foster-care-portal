<div class="modal fade" id="y_achive<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php
				include '../../security/connection.php';
				$video_archive_query = mysqli_query($con, "SELECT * FROM y_video WHERE y_video_id = '".$id."'");
				$archive_display = mysqli_fetch_array($video_archive_query);
				$video_id = $archive_display['y_video_id'];
				$video_links = $archive_display['y_video_link'];
				$video_title = $archive_display['y_video_title'];
			?>
			<form method="post" action="youtube_video.php" enctype="multipart/form-data">
				<div class="modal-body">
					<center>
						<h3>Are you sure you want to archive</h3><br>
						<p><?php echo $video_title; ?></p>
                        <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
                        <object width="100%" height="270" data="<?php echo $video_links; ?>" type="application/x-shockwave-flash">
                            <param name="src" value="<?php echo $video_links; ?>" />
                        </object>
					</center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="video_archive_yes" class="btn btn-primary">Yes</button>
				</div>
			</form>
		</div>
	</div>
</div>