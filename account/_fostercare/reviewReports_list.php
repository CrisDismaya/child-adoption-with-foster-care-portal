<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenIds = $_SESSION['credenId'];

		$getIds = "SELECT * FROM credentials 
			JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
			WHERE credenId = '$credenIds'";
		$disIds = $con->query($getIds);
		if ($disIds->num_rows > 0) {
			while($rowIds = $disIds->fetch_assoc()) {
				$fosterhomeIds = $rowIds['fosterhomeId'];
			}
		}
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Review Reports </h1>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<th>Photo</th>
								<th>Details</th>
							</thead>
							<tbody>
							<?php
								include '../../security/connection.php';
								$getReport = "SELECT * FROM parent_report
									JOIN fosterparent ON parent_report.prFosterparentId = fosterparent.fosterparentId
									JOIN fosterhome ON fosterparent.fpFosterparentId = fosterhome.fosterhomeId
									WHERE fosterhomeId = '$fosterhomeIds' ORDER BY parent_report_id DESC";
								$disReport = $con->query($getReport);   
								if ($disReport->num_rows > 0) {
									while($row_report = $disReport->fetch_assoc()) {
										$foster_parent_id = $row_report['fosterparentId'];
										$foster_parent_photo = $row_report['fpPtoho'];
										$foster_parent_name = $row_report['fpFname']." ".$row_report['fpMname']." ".$row_report['fpLname'];
										$report_date = $row_report['prCreated'];
										$new_report_date = date("M d, Y h:i A", strtotime($report_date));

										$children_id = $row_report['prChildrenId'];
										$parent_report_id = $row_report['parent_report_id'];
										
									?>
										<tr>
											<td width="15%"> <img src="<?php echo $foster_parent_photo; ?>" width=150 hieght=150> </td>
											<td>
												<span><b>Name : </b><i><?php echo $foster_parent_name; ?></i></span><br>
												<span><b>Date : </b><i><?php echo $new_report_date; ?></i></span><br>
												<a href="reviewReports_Details.php?fosterparent_id=<?php echo $foster_parent_id; ?>&&children_id=<?php echo $children_id; ?>&&parent_report_id=<?php echo $parent_report_id; ?>" class="btn btn-primary btn-sm" style="margin-top: 10px;">
													View Details
												</a>
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