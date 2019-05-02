<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'navigation.php'; ?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Report Foster Care Unit </h1>
				</div>
			</div>

			<div class="container-fluid">
				<div class="panel panel-default" style="height: 530px; overflow-y: auto;">
					<div class="panel-body">
					<?php
						include '../../security/connection.php';
						$getDistrict = "SELECT * FROM fosterhome";
						$disDistrict = $con->query($getDistrict);   
						if ($disDistrict->num_rows > 0) {
							while($rows = $disDistrict->fetch_assoc()) {
								$fosterhomeId = $rows['fosterhomeId'];
								$fosterName = $rows['fhName'];
								$fosterAddress = $rows['fhAddress'];
								?>
								<a href="reportDetails.php?fosterhomeId=<?php echo $fosterhomeId; ?>">
									<div class="col-lg-3">
										<div class="panel panel-default">
											<div class="panel-body">
												<center>
													<img src="image/facility.png" width="150" style="margin-bottom: 10px;"><br>
													<span style="font-size: 15px; text-decoration: none; color: #090909"><i><b><?php echo $fosterName; ?></b>	</i></span>
												</center>
											</div>
										</div>
									</div>
								</a>
								<?php
							}
						}else{
							echo "
							<center>
								<h3>No Available Data</h3>
							</center>
							";
						}
					?>	
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
</body>
</html>