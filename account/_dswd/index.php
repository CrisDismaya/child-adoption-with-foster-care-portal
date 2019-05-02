<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'navigation.php'; ?>
	<?php
		include '../../security/connection.php';

		$district_one = " "; 
		$district_one_count = "SELECT COUNT('fhDistrict') as District_One_Counts FROM fosterhome 
			WHERE fhDistrict = '1'";
		$district_one_result = $con->query($district_one_count);
		if ($district_one_result->num_rows > 0) {
			while($row_district_one = $district_one_result->fetch_assoc()){
				$district_one = $row_district_one['District_One_Counts'];
			}
		}

		$district_two = " "; 
		$district_two_count = "SELECT COUNT('fhDistrict') as District_Two_Counts FROM fosterhome 
			WHERE fhDistrict = '2'";
		$district_two_result = $con->query($district_two_count);
		if ($district_two_result->num_rows > 0) {
			while($row_district_two = $district_two_result->fetch_assoc()){
				$district_two = $row_district_two['District_Two_Counts'];
			}
		}

		$district_three = " "; 
		$district_three_count = "SELECT COUNT('fhDistrict') as District_Three_Counts FROM fosterhome 
			WHERE fhDistrict = '3'";
		$district_three_result = $con->query($district_three_count);
		if ($district_three_result->num_rows > 0) {
			while($row_district_three = $district_three_result->fetch_assoc()){
				$district_three = $row_district_three['District_Three_Counts'];
			}
		}

		$district_four = " "; 
		$district_four_count = "SELECT COUNT('fhDistrict') as District_Four_Counts FROM fosterhome 
			WHERE fhDistrict = '4'";
		$district_four_result = $con->query($district_four_count);
		if ($district_four_result->num_rows > 0) {
			while($row_district_four = $district_four_result->fetch_assoc()){
				$district_four = $row_district_four['District_Four_Counts'];
			}
		}
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> DSWD </h1>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-institution fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $district_one; ?></div>
									<div>District One!</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-red">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-institution fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $district_two; ?></div>
									<div>District Two!</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-green">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-institution fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $district_three; ?></div>
									<div>District Three!</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-institution fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $district_four; ?></div>
									<div>District Four!</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
</body>
</html>