<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/news.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
	?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> List News </h1>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Table
				</div>

				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<th width="20%">Photo</th>
								<th width="20%">Title</th>
								<th width="13%">Date</th>
								<th width="25%">Description</th>
								<th width="25%">Action</th>
							</thead>

							<tbody>
							<?php
								include '../../security/connection.php';
								$getNews = "SELECT * FROM news WHERE nwCredenId = '$credenId' AND nwStatus = 0";
								$disNews = $con->query($getNews);   
								if ($disNews->num_rows > 0) {
									while($row = $disNews->fetch_assoc()) {
										$nwPath = $row['nwPath'];
										$nwDate = $row['nwDate'];
										$newnwDate = date("M d, Y", strtotime($nwDate));
										$nwTitle = $row['nwTitle'];
										$nwContent = $row['nwContent'];
									?>
									<tr>
										<td>
											<center>
												<img src="<?php echo $nwPath; ?>" width=120 height=100>
											</center>
										</td>
										<td><?php echo $nwTitle; ?></td>
										<td><?php echo $newnwDate; ?></td>
										<td><?php echo $nwContent; ?></td>
										<td>
											<a href="#myEdit<?php echo $row['newsId']; ?>" class="btn btn-warning" data-toggle="modal">
												<span class='fa fa-edit'></span> Edit
											</a>
											<?php include('news_edit.php'); ?>	

											<a href="#myArchive<?php echo $row['newsId']; ?>" class="btn btn-danger" data-toggle="modal">
												<span class='fa fa-trash'></span> Archive
											</a>
											<?php include('news_archive.php'); ?>	
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