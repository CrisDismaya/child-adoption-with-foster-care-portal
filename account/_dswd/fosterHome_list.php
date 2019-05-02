<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/accountStatus.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> List of Registered Foster Home </h1>
				</div>

				<div class="container-fluid">
					<div class="col-lg-4">
						<table class="table table-borderless">
							<tr>
								<td width="30%" style="font-size: 15px;"><b style="line-height: 33px;">Filter By :</b></td>
								<td>
									<select name="FHDistrict" id="catList" class="form-control" required>
										<option hidden>SELECT DISTRICT</option>
										<option value="0">ALL DISTRICT</option>
										<?php
											include '../../security/connection.php';
											$getDistrict = mysqli_query($con,"SELECT * FROM district");		
											while($rows = mysqli_fetch_array($getDistrict)) {
											$catid = isset($_GET['category']) ? $_GET['category'] : 0;
											$selected = ($catid == $rows['muniDistrict']) ? " selected" : "";
											$disId = $rows['disId'];
											$disName = $rows['disName'];
											$muniDistrict = $rows['muniDistrict'];
												echo "
													<option $selected value=". $muniDistrict .">". $disName ."</option>
												";
											}
										?>	
									</select>
								</td>
							</tr>
						</table>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<form method="post" action="fosterHome_list.php" enctype="multipart/form-data">
										<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
												<th width="15%">District</th>
												<th width="20%">Foster Care</th>
												<th width="20%">Complete Address</th>
												<th width="17%">Minicipality</th>
												<th width="12%">Contact No</th>
												<th width="12%">Action</th>
											</thead>

											<tbody>
												<?php
													include '../../security/connection.php';
													$where = "";
													if(isset($_GET['category'])) {
														$catid=$_GET['category'];
														$where = "WHERE fosterhome.fhDistrict = $catid";
													}

													$result = mysqli_query($con,"SELECT * FROM district 
														JOIN fosterhome ON district.muniDistrict = fosterhome.fhDistrict
														JOIN municipal ON fosterhome.fhMunicipal = municipal.muniId $where");

													if ($result->num_rows > 0) {
														// output data of each row
														while($row = mysqli_fetch_array($result)) {
															$fhDistrict = $row['disName'];
															$fhName = $row['fhName'];
															$fhAddress = $row['fhAddress'];
															$fhMunicipal = $row['muniName'];
															$fhContact = $row['fhContact'];
															$fhContact = $row['fhContact'];

															$fhaccStatus = "";
															if ($row['fhaccStatus'] == 0) {
																$fmaccStatus = "<center><span style='color: #13F718; font-size: 15px;'><b>Activate</b></span></center>";
															} else {
																$fmaccStatus = "<center><span style='color: #F71313; font-size: 15px;'><b>Deactivate</b></span></center>";
															}
															?>
															<tr>
																<td><?php echo $fhDistrict; ?></td>
																<td><?php echo $fhName; ?></td>
																<td><?php echo $fhAddress; ?></td>
																<td><?php echo $fhMunicipal; ?></td>
																<td><?php echo $fhContact; ?></td>
																<td>
																	<a href="#myStatus<?php echo $row['fosterhomeId']; ?>" style="text-decoration: none;" data-toggle="modal">
																		<?php echo $fmaccStatus; ?>
																	</a>
																	<?php include('accountStatus.php'); ?>
																</td>
															</tr>
															<?php
														}
													}
												?>
											</tbody>
										</table>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?php include 'includes/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
				responsive: true
			});
		});

		$(document).ready(function(){
			$("#catList").on('change', function(){
				if($(this).val() == 0) {
					window.location = 'fosterHome_list.php';
				}
				else {
					window.location = 'fosterHome_list.php?category='+$(this).val();
				}
			});
		});
	</script>
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
