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
					<h1 class="page-header"> Report Details </h1>
				</div>
			</div>

			

			<div class="container-fluid">
				<div class="panel panel-default" style="height: 530px; overflow-y: auto;">

					<div class="panel-body">
						
						
						<?php 
							include '../../security/connection.php';
							$fosterId = $_GET['fosterhomeId'];

							$getReport = "SELECT * FROM fosterhome WHERE fosterhomeId = '$fosterId'";
							$disReport = $con->query($getReport);   
							if ($disReport->num_rows > 0) {
								while($row = $disReport->fetch_assoc()) {
									$fosterName = $row['fhName'];
									$fosterAddress = $row['fhAddress'];
									$fosterContact = $row['fhContact'];
									$fosterEmail = $row['fmEmail'];
								?>
								<table class="table table-borderless">
									<tr>
										<td colspan="3"><a href="reportFostercare.php" class="btn btn-primary"> BACK </a></td>
									</tr>
									<tr>
										<td width="15%">
											<img src="image/facility.png"  class="img-thumbnail" width="140" style="margin-right: 15px;"/>
										</td>
										<td width="13%">
											<div style="margin-top: 40px;">
												<span><b>Name :</b></span><br>
												<span><b>Address :</b></span><br>
												<span><b>Contact No. :</b></span><br>
												<span><b>Email :</b></span><br>
											</div>
										</td>
										<td>
											<div style="margin-top: 40px;">
												<span><i><?php echo $fosterName; ?></i></span><br>
												<span><i><?php echo $fosterAddress; ?></i></span><br>
												<span><i><?php echo $fosterContact; ?></i></span><br>
												<span><i><?php echo $fosterEmail; ?></i></span><br>
											</div>
										</td>
									</tr>
									<tr><td colspan="3"><hr></td></tr>
									<tr>
										<td colspan="3">
											<div class="col-lg-8" style="overflow-y: auto; height: 250px;">
												<table class="table table-bordered table-hover">
													<thead style="background-color: #CBCBCB;">
														<th><b>File Name</b></th>
														<th><b>Subject Title</b></th>
														<th><b>Action</b></th>
													</thead>
													<tbody>
														<?php 
															include '../../security/connection.php';
															$fosterId = $_GET['fosterhomeId'];

															$getReport = "SELECT * FROM reportcare WHERE rcfosterHomeid = '$fosterId'";
															$disReport = $con->query($getReport);   
															if ($disReport->num_rows > 0) {
																while($row = $disReport->fetch_assoc()) {
																	$reportCareId = $row['reportCareId'];
																	$rcfilePath = $row['rcfilePath'];
																	$rcfileName = $row['rcfileName'];
																	$rsTitile = $row['rsTitile'];
																	?>
																		<tr>
																			<td width="50%"><?php echo $rcfileName?></td>
																			<td width="50%"><?php echo $rsTitile?></td>
																			<td>
																				<a href="<?php echo $rcfilePath?>" class="btn btn-default" style="width: 100%;" download>
																					<span class="fa fa-download"></span> Donwload
																				</a>
																			</td>
																		</tr>
																	<?php
																}
															} else {
																echo "<tr><td colspan='3'><center><h3>No Available Files</h3></center></td></tr>";
															}
														?>
													</tbody>
												</table>
											</div>
										</td>
									</tr>
								</table>
								<?php
								}
							}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<style>
		.table-borderless > tbody > tr > td,
		.table-borderless > tbody > tr > th,
		.table-borderless > tfoot > tr > td,
		.table-borderless > tfoot > tr > th,
		.table-borderless > thead > tr > td,
		.table-borderless > thead > tr > th {
			border: none;
		}
	</style>
</body>
</html>