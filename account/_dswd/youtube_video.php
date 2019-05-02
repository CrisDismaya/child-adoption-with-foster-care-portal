<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/youtube_video.php'; ?> 
<body>
	<?php include 'navigation.php'; ?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Yotube Video </h1>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="row">

					<form method="POST" action="youtube_video.php"  enctype="multipart/form-data">
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<label>Links</label>
									<input type="text" name="y_links" class="form-control" placeholder="http://www.youtube.com/watch?v=Ahg6qcgoay4" autocomplete="off" required> <br>
									<input type="text" name="y_title" class="form-control" autocomplete="off" required> <br>
									<button type="submit" name="save_links" class="btn btn-md btn-primary pull-right">
										Save
									</button>
								</div>
							</div>
						</div>
					</form>

					<!-- <object width="425" height="350" data="http://www.youtube.com/v/Ahg6qcgoay4" type="application/x-shockwave-flash">
						<param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" />
					</object> -->
					<div class="col-lg-12">
						<div class="panel panel-default" style="height: 450px; overflow-y: auto;">
							<div class="panel-body">
								<?php
									include '../../security/connection.php';
									$y_query = "SELECT * FROM y_video WHERE y_archive = 0";
									$y_display = $con->query($y_query);   
									if ($y_display->num_rows > 0) {
										while($y_row = $y_display->fetch_assoc()) {
											$id = $y_row['y_video_id'];
											$links = $y_row['y_video_link'];
											$titles = $y_row['y_video_title'];
											?>
											<div class="col-md-4" style="text-align: center;">
												<object width="100%" height="200" data="<?php echo $y_video_link; ?>"></object>
												<span style="font-size: 20px;"><b><?php echo $titles; ?></b></span>

												<a href="#y_achive<?php echo $id; ?>" class="btn btn-danger" data-toggle="modal" style="width:100%;">
													<span class="fa fa-trash"></span> Archive
												</a>
												<?php include('youtube_video_archive.php'); ?>
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
	<?php include '../includes/script.php'; ?>
</body>
</html>