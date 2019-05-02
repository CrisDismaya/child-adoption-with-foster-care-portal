<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/children.php'; ?>
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
					<h1 class="page-header"> Children List </h1>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Table
				</div>

				<div class="panel-body">
					<div class="dataTable_wrapper">
						<div class="col-lg-4">
							<select class="form-control" id="catList">
								<option hidden>SELECT STATUS</option>
								<option value="0">ALL STATUS</option>
								<?php
									include 'security/connection.php';
									$Municipality = mysqli_query($con, "SELECT * FROM childstatus");		
									while($rows = mysqli_fetch_array($Municipality)) {
										$catid = isset($_GET['category']) ? $_GET['category'] : 0;
										$selected = ($catid == $rows['childstatusId']) ? " selected" : "";
										$childstatusId = $rows['childstatusId'];
										$csName = $rows['csName'];
										echo "
											<option $selected value=". $childstatusId .">". $csName ."</option>
										";
									}
								?>
							<select><br>
						</div>
						
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<th width="20%">Photo</th>
								<th width="20%">Name</th>
								<th width="20%">Gender</th>
								<th width="20%">Address</th>
								<th width="25%">Action</th>
							</thead>

							<tbody>
							<?php
								include '../../security/connection.php';
								$where = "";
								if(isset($_GET['category'])) {
									$catid=$_GET['category'];
									$where = "WHERE children.chStatus = $catid";
								}

								$disChildren = mysqli_query($con, "SELECT * FROM children
									JOIN fosterhome ON children.chFosterhomeId = fosterhome.fosterhomeId
									$where AND chFosterhomeId = '$fosterhomeIds'");

								if ($disChildren->num_rows > 0) {
									// output data of each row
									while($row = mysqli_fetch_array($disChildren)) {
										$chPhoto = $row['chPhoto'];
										$children_name = $row['chFname']." ".$row['chMname']." ".$row['chLname'];

										$children_gender = "";
										if ($row['chGender'] == 1) {
											$children_gender = "Male";
										} else {
											$children_gender = "Female";
										}

										$children_address = $row['chAddress'];
									?>
									<tr>
										<td>
											<center>
												<img src="<?php echo $chPhoto; ?>" width=120 height=100>
											</center>
										</td>
										<td><?php echo $children_name; ?></td>
										<td><?php echo $children_gender; ?></td>
										<td><?php echo $children_address; ?></td>
										<td>
											<a href="#myEdit<?php echo $row['childrenId']; ?>" class="btn btn-warning" data-toggle="modal">
												<span class='fa fa-edit'></span> Edit
											</a>
											<?php include('children_edit.php'); ?>	
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
		$(document).ready(function(){
			$("#catList").on('change', function(){
				if($(this).val() == 0)
				{
					window.location = 'children_list.php';
				}
				else
				{
					window.location = 'children_list.php?category='+$(this).val();
				}
			});
		});
	</script>
</body>
</html>