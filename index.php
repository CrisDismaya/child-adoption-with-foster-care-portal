<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
	<style type="text/css">
		ul > li > a > b > i{
			color: #000;
		}
	</style>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php include'_slider1.php'; ?>
	
	<section id="recent-works" style="padding: 10px 0; background-color: #fff;">
		<div class="container" style="width: 100%; padding: 0; margin: 0;">
			<div class="col-lg-12">
				
				<div class="col-lg-4">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							<b>Government Link</b>
						</div>
						<div class="panel-body" style="background-color: #fff; height: 300px; overflow-y: auto;">
							<div class="container-fluid">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
									<ul style="text-decoration: underline; text-decoration-color: #000;">
										<li><a href="http://dilg.gov.ph/" target="_blank"><b><i>Department of the Interior and Local Government</i></b></a></li>
										<li><a href="http://president.gov.ph/" target="_blank"><b><i>Office of the President</i></b></a></li>
										<li><a href="http://ovp.gov.ph/" target="_blank"><b><i>Office of the Vice President</i></b></a></li>
										<li><a href="http://ovp.gov.ph/" target="_blank"><b><i>Senate of the Philippines</i></b></a></li>
										<li><a href="http://congress.gov.ph/" target="_blank"><b><i>House of Representative</i></b></a></li>
										<li><a href="http://cs.judiciary.gov.ph/" target="_blank"><b><i>Supreme court of the Philippines</i></b></a></li>
										<li><a href="http://ca2.judiciary.gov.ph/caws-war/" target="_blank"><b><i>Court of Appeals</i></b></a></li>
										<li><a href="http://sb.judiciary.gov.ph/" target="_blank"><b><i>Sandigan Bayan</i></b></a></li>
										<li><a href="http://dswd.gov.ph/" target="_blank"><b><i>Department of Social Welfare and Development</i></b></a></li>
									</ul>
									
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							<b>News</b>
						</div>
						<div class="panel-body" style="background-color: #fff; height: 300px; overflow-y: auto;">
							<table class="table table-bordered table-striped table-hover">
								<thead style="background-color: #F1F1F1;">
									<th width="20%">Date</th>
									<th width="35%">Title</th>
									<th width="45%">Description</th>
								</thead>
								<thead>
									<?php
										include'security/connection.php';
										$getNews = "SELECT * FROM news WHERE nwStatus = 0";
										$disNews = $con->query($getNews);   
										if ($disNews->num_rows > 0) {
											while($rowNews = $disNews->fetch_assoc()) {
												$newsId = $rowNews['newsId'];
												$nwPath = $rowNews['nwPath'];
												$nwTitle = $rowNews['nwTitle'];
												$nwDate = $rowNews['nwDate'];
												$newDate = date("m  d, Y", strtotime($nwDate));
												$Description = $rowNews['nwContent'];

												$nwDescription = $rowNews['nwContent'];
												$subDescription = substr($nwDescription, 0, 30);
												?>
												<!-- Event -->
												<tr>
													<td><?php echo $newDate; ?></td>
													<td style="text-align: center;">
														<a href="news.php?newsId=<?php echo $newsId; ?>" style="color: #000; text-decoration: underline; cursor: pointer;">
															<b><?php echo $nwTitle; ?></b>
														</a>
													</td>
													<td><?php echo $subDescription; ?> ...</td>
												</tr>
												<?php
											}
										} else {
											echo"
											<tr>
												<td colspan='3'>
													<center>
														<h3>No Available Data</h3>
													</center>
												</td>
											</tr>
											";
										}
									?>
								</thead>
							</table>
						</div>
					<!-- 	<div class="panel-footer text-center">
							<a href="news.php" style="color: #000;">
								<i>See All</i>
							</a>
						</div> -->
					</div>
				</div>

				<div class="col-lg-4">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							<b>Follow us on</b>
						</div>
						<div class="panel-body" style="background-color: #fff; height: 300px; overflow-y: auto;">
							<a href="https://www.facebook.com/adoption-and-foster-care-portal-1992068864434760/?modal=admin_todo_tour/" target="_blank" class="btn btn-lg btn-primary" style="width: 100%; background-color: #428bca;">
								<i class="fa fa-facebook"></i> Follow us on our Facebook Page
							</a>
							<!-- <a href="https://www.twitter.com/" target="_blank" class="btn btn-lg btn-primary" style="width: 100%; background-color: #428bca;">
								<i class="fa fa-facebook"></i> Sign in with Twitter
							</a>
							<a href="https://www.skype.com/" target="_blank" class="btn btn-lg btn-primary" style="width: 100%; background-color: #428bca;">
								<i class="fa fa-facebook"></i> Sign in with Skype
							</a>
							<a href="https://www.instagram.com/" target="_blank" class="btn btn-lg btn-primary" style="width: 100%; background-color: #428bca;">
								<i class="fa fa-facebook"></i> Sign in with Instagram
							</a> -->
						</div>
					</div>
				</div>

				<div class="col-lg-8">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							<b>Videos</b>
						</div>
						<div class="panel-body" style="background-color: #fff; height: 400px; overflow-y: auto;">
							
							<div class="row">
							<?php 
								include'security/connection.php';
								$getVideo = "SELECT * FROM y_video WHERE y_archive = 0";
								$disVideo = $con->query($getVideo);   
								if ($disVideo->num_rows > 0) {
									while($rowVideo = $disVideo->fetch_assoc()) {
										$y_video_id = $rowVideo['y_video_id'];
										$y_video_link = $rowVideo['y_video_link'];
										$y_title = $rowVideo['y_video_title'];
										$y_created = $rowVideo['y_created'];
										$new_y_created = date("F  d, Y", strtotime($y_created));
										?>
										<div class="col-lg-4 col-md-6 col-xs-12" style="text-align:center;">
											<object width="100%" height="200" data="<?php echo $y_video_link; ?>" type="application/x-shockwave-flash">
												<param name="src" value="<?php echo $y_video_link; ?>" />
											</object>
											<span style="font-size: 15px;"><i><b><?php echo $y_title; ?></b></i></span>
										</div>
										<?php
									}
								} else {
									echo "
										<center>
											<h2> No Data </h2>
										</center>
									";
								}
							?>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
</body>
</html>