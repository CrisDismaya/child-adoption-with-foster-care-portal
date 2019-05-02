<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/facility.php'; ?>
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
					<h1 class="page-header"> Facility Add and View </h1>
				</div>
			</div>

			<form method="post" action="facility_all.php" enctype="multipart/form-data">
				<div class="container-fluid">
					<input type="hidden" name="faCredenId" value="<?php echo $credenId; ?>">
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<center><br>
									<a href="#" onclick="document.getElementById('Photo').click(); return false;">
										<img id="Photo" src="image/profile.png" width=230 height=230 alt="your image"
											style="border-radius:10%; border: 1px solid; border-color:  #000000;"/>
									</a></br></br>
									<input type="file" name="faPhoto" id="Photo" accept="image/*" onchange="user_photo(this);" required/><br>
								</center>
								<label>Facility Name</label><br>
								<input type="text" name="faName" id="faName" class="form-control" placeholder="Facility Name" required><br>
								<button type="submit" name="faSubmit" id="faSubmit" class="btn btn-primary pull-right">
									Submit
								</button>
							</div>
						</div>
					</div>
			</form>

					<div class="col-lg-8">
						<div class="panel panel-default" style="overflow-y: auto; height: 540px;">
							<div class="panel-body">
								
								<?php 
									include '../../security/connection.php';
									$getFacility = "SELECT * FROM facility WHERE faStatus = 1 AND faCredenId = '$credenId'";
									$disFacility = $con->query($getFacility);
									if ($disFacility->num_rows > 0) {
										while($row = $disFacility->fetch_assoc()) {
											$faPhoto = $row['faPhoto'];
											$faName = $row['faName'];
										?>
										<div class="col-lg-4" style="margin: 5px 0px; height: 250px;">
											<div class="panel panel-default">
												<div class="panel-body">
													<center>
														<a href="#myPopup<?php echo $row['facilityId']; ?>" data-toggle="modal">
															<img src="<?php echo $faPhoto; ?>" class="img-thumbnail" style="margin-bottom: 10px;">
														</a>
														<?php include('facility_popup.php'); ?>
														<label><?php echo $faName; ?></label>
													</center>
													<a href="#myArchive<?php echo $row['facilityId']; ?>" class="btn btn-danger" data-toggle="modal" style="width: 100%;">
														<span class='fa fa-archive'></span> Archive
													</a>
													<?php include('facility_archive.php'); ?>
												</div>
											</div>
										</div>
										<?php
										}
									}
								?>
								
							</div>
						</div>
					</div>

				</div>

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<script type="text/javascript">
		function user_photo(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#Photo')
					.attr('src', e.target.result)
					.width(230)
					.height(230);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
</body>
</html>