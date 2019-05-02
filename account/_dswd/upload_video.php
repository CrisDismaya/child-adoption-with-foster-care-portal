<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/upload_video.php'; ?>
<body>
	<?php include 'navigation.php'; ?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Upload Video </h1>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="row">
					
					<form method="post" action="upload_video.php" enctype="multipart/form-data">
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<input type="file" name="video_file" class="form-control" accept="video/*" required><br>
									<input type="text" name="video_title" class="form-control" placeholder="Video Title" autocomplete="off" required><br>
									<button type="submit" name="btn_upload" class="btn btn-md btn-success pull-right">
										Upload
									</button>
								</div>
							</div>
						</div>
					</form>

					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Video
							</div>
							<div class="panel-body" style="height: 290px; overflow-y: auto;">
								<div class="container-fluid">
									<div class="row">
										<?php
											include '../../security/connection.php';
											$dl_query = "SELECT * FROM video";
											$dl_display = $con->query($dl_query);   
											if ($dl_display->num_rows > 0) {
												while($dl_row = $dl_display->fetch_assoc()) {
													$video_path = $dl_row['video_path'];
													$video_name = $dl_row['video_name'];
													$video_title = $dl_row['video_title'];
													?>
													<div class="col-lg-4" style="border: 1px solid; text-align: center;">							<video width="280" autoplay style="margin-top: 10px;">
															<source src="<?php echo $video_path; ?>" type="video/mp4">
															Sorry, your browser doesn't support the video element.
														</video><br>
														<label style="font-size: 20px;"><?php echo $video_title; ?></label>
													</div>
													<?php
												}
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
</body>
</html>