<div class="modal fade" id="modals<?php echo $video_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php
				include 'security/connection.php';
				$video_query = mysqli_query($con, "SELECT * FROM video WHERE video_id = '".$video_id."'");
				$video_display = mysqli_fetch_array($video_query);
				$video_path_dis = $video_display['video_path'];
				$video_name_dis = $video_display['video_name'];
				$video_title_dis = $video_display['video_title'];
				$video_created_dis = $video_display['video_created'];
				$newVideo_created_dis = date("F  d, Y", strtotime($video_created_dis));
			?>
			<div class="modal-body">
				<video width="500" autoplay controls style="margin-top: 10px;">
					<source src="account/_dswd/<?php echo $video_path_dis; ?>" type="video/mp4">
					Sorry, your browser doesn't support the video element.
				</video><br>
			</div>
			<div class="modal-footer" style="text-align: center;">
				<label style="font-size: 15px; color: #000;"><?php echo $video_title_dis; ?></label>
			</div>
		</div>
	</div>
</div>