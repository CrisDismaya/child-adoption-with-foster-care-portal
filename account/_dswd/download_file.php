<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/download.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Upload Files </h1>
				</div>
			</div>

			<form method="post" action="download_file.php" enctype="multipart/form-data">
				<div class="col-lg-5">
					<div class="panel panel-default">
						<div class="panel-body">
							<input type="file" name="download_file" id="download_file" class="form-control" accept="application/pdf" required><br>
							<button type="submit" name="dl_save" id="dl_save" class="btn btn-primary pull-right">
								Save
							</button>
						</div>
					</div>
				</div>
			</form>

			<div class="col-lg-7">
				<div class="panel panel-default">
					<div class="panel-body">

						<div class="container-fluid">
							<div class="dataTable_wrapper">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<th width="55%">File Name</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
											include '../../security/connection.php';

											$dl_query = "SELECT * FROM download_file WHERE dl_file_status = 0";
											$dl_display = $con->query($dl_query);   
											if ($dl_display->num_rows > 0) {
												while($dl_row = $dl_display->fetch_assoc()) {
													$download_id = $dl_row['download_id'];
													$dl_path = $dl_row['dl_path'];
													$dl_filename = $dl_row['dl_filename'];
													?>
														<tr>
															<td><?php echo $dl_filename; ?></td>
															<td style="text-align: center;">
																<a href="<?php echo $dl_path?>" class="btn btn-default" download>
																	<span class="fa fa-download"></span> Donwload
																</a>

																<a href="#dl_archive<?php echo $download_id; ?>" class="btn btn-danger" data-toggle="modal">
																	<span class="fa fa-trash"></span> Archive
																</a>
																<?php include('download_archive.php'); ?>
															</td>
														</tr>
													<?php
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
				responsive: true
			});
		});
	</script>
</body>
</html>