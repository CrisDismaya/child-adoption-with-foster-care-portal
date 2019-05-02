<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php include'_slider1.php'; ?>
	
	<section id="recent-works" style="padding: 10px 0; background-color: #fff;">
		<div class="container" style="width: 100%; padding: 0; margin: 0;">
			<div class="col-lg-12">

				<div class="col-lg-8">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							Download
						</div>
						<div class="panel-body" style="background-color: #fff; height: 300px; overflow-y: auto;">
							<table class="table table-bordered table-striped">
								<thead style="background-color: #F1F1F1;">
									<th width="60%">File Name</th>
									<th width="40%">Download</th>
								</thead>
								<tbody>
									<?php
										include 'security/connection.php';

										$dl_query = "SELECT * FROM download_file WHERE dl_file_status = 0";
										$dl_display = $con->query($dl_query);   
										if ($dl_display->num_rows > 0) {
											while($dl_row = $dl_display->fetch_assoc()) {
												$download_id = $dl_row['download_id'];
												$dl_path = $dl_row['dl_path'];
												$dl_filename = $dl_row['dl_filename'];
												?>
												<tr>
													<td><p><?php echo $dl_filename; ?></p></td>
													<td style="text-align: center;">
														<a href="account/_dswd/<?php echo $dl_path?>" class="btn btn-primary" style="background-color: #428bca;" download>
															<span class="fa fa-download"></span> Donwload
														</a>
													</td>
												</tr>
												<?php
											}
										} else {
											echo "
												<tr>
													<td colspan='2' style='text-align: center;'>
														<h1 style='color: #000;'> No Data </h1>
													</td>
												</tr>
											";
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="panel panel-primary">
						<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							Follow Us on
						</div>
						<div class="panel-body" style="background-color: #fff; height: 300px; overflow-y: auto;">
							<a href="https://www.facebook.com/adoption-and-foster-care-portal-1992068864434760/?modal=admin_todo_tour/" target="_blank" class="btn btn-lg btn-primary" style="width: 100%; background-color: #428bca;">
								<i class="fa fa-facebook"></i> Follow us on our Facebook Page
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
					<div class="panel-heading text-center">
						News
					</div>
					<div class="panel-body" style="background-color: #fff; height: 300px; overflow-y: auto;">
					</div>
				</div>
			</div> -->

		</div>
	</section>

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
</body>
</html>