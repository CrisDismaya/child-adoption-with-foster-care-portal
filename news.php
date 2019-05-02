<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>

	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>News</h2>
			</div>  

			<div class="col-lg-12">
				
				<div class="col-lg-5">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							<b>List of News</b>
						</div>
						<div class="panel-body" style="background-color: #fff; height: 550px; overflow-y: auto;">
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
														<a href="news.php?newsId=<?php echo $newsId; ?>" style="color: #000; text-decoration: underline;">
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
					</div>
				</div>

				<div class="col-lg-7">
					<div class="panel panel-primary" style="border: 2px solid #428bca;">
						<div class="panel-heading text-center">
							<b>News Details</b>
						</div>
						<div class="panel-body" style="background-color: #fff; height: 550px; overflow-y: auto;">
							<table class="table table-borderless">
								<?php
									include'security/connection.php';
									$newsId = $_GET['newsId'];

									$getNews = "SELECT * FROM news WHERE newsId = '$newsId' AND nwStatus = 0";
									$disNews = $con->query($getNews);   
									if ($disNews->num_rows > 0) {
										while($rowNews = $disNews->fetch_assoc()) {
											$newsId = $rowNews['newsId'];
											$nwPath = $rowNews['nwPath'];
											$nwTitle = $rowNews['nwTitle'];
											$nwDate = $rowNews['nwDate'];
											$newDate = date("M  d, Y", strtotime($nwDate));
											$nwContent = $rowNews['nwContent'];
											?>
											<tr>
												<td colspan="2">
													<center>
														<img src="account/_fostercare/<?php echo $nwPath; ?>" height=200 style="margin-top: 10px;">
													</center>
												</td>
												<tr>
													<td width="20%"><b>Title : </b></td>
													<td><b><?php echo $nwTitle; ?></b></td>
												</tr>
											</tr>
											<tr>
													<td width="20%"><b>Date : </b></td>
													<td><b><?php echo $newDate; ?></b></td>
												</tr>
											</tr>
											<tr>
													<td width="20%"><b>Description : </b></td>
													<td><p style="text-align: justify;"><b><?php echo $nwContent; ?></b></p></td>
												</tr>
											</tr>
											<?php
										}
									} else {
										echo "
											<tr>
												<td colspan='2'>
													<center>
														<h1 style='color: #000;'> No Data </h1>
													</center>
												</td>
											</tr>
										";
									}
								?>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div><!--/container-->
	</section><!--/pricing-page-->

	


	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
</body>
</html>