<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/sendReport.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];

		$fosterId = "";
		$getFosterId = "SELECT * FROM credentials
			JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
			WHERE credenId = '$credenId' AND credenLevel = 2";
		$disFosterId = $con->query($getFosterId);   
			if ($disFosterId->num_rows > 0) {
				while($rowF = $disFosterId->fetch_assoc()) {
					$fosterId = $rowF['fosterhomeId'];
				}
			}
	?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Send report to Dswd </h1>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-default">
					<form method="post" action="sendReport.php" enctype="multipart/form-data">
						<div class="panel-body">
							<input type="hidden" name="srCredenId" value="<?php echo $fosterId?>">
							<input type="file" name="srFile" id="srFile" accept="application/pdf" class="form-control" required><br>
							<input type="text" name="srName" id="srName" class="form-control" placeholder="File name" autocomplete="off" required><br>
							<button type="submit" name="srSend" class="btn btn-primary pull-right">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body" style="height: 400px; overflow-y: auto;">
						<table class="table table-bordered">
							<thead style="background-color: #E4E4E4">
								<th width="50%">File</th>
								<th width="50%">File Name</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
									include '../../security/connection.php';
									$getData = "SELECT * FROM reportcare WHERE rcfosterHomeid = '$fosterId'";
									$disData = $con->query($getData);   
									if ($disData->num_rows > 0) {
										while($rowD = $disData->fetch_assoc()) {
											$file_name = $rowD['rcfileName'];
											$file_title = $rowD['rsTitile'];
											$file_path = $rowD['rcfilePath'];
											?>
												<tr>
													<td><?php echo $file_name; ?></td>
													<td><?php echo $file_title; ?></td>
													<td>
														<a href="<?php echo $file_path; ?>" class="btn btn-default" style="width: 100%;" download>
															<span class="fa fa-download"></span> Donwload
														</a>
													</td>
												</tr>
											<?php
										}
									} else {
										echo "
											<tr>
												<td colspan='3'>
													<center><h3> No Available Data </h3></center>
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

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
</body>
</html>