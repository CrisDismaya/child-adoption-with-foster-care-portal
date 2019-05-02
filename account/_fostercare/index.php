<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
		$credenUser = $_SESSION['credenUser'];

		$orphanage_query = "SELECT * FROM fosterhome 
			JOIN credentials ON fosterhome.fosterhomeId = credentials.credenAnyid
			WHERE fhUsername = '$credenUser' AND credenLevel = 2 ";
		$orphanage_display = $con->query($orphanage_query);
		if ($orphanage_display->num_rows > 0) {
			while($row_orpha = $orphanage_display->fetch_assoc()) {
				$fosterhome_id = $row_orpha['fosterhomeId'];
				$orphanage_name = $row_orpha['fhName'];
			}
		}

		$parent_male = " "; 
		$parent_male_count = "SELECT COUNT('fpGender') as Parent_Male_Counts FROM fosterparent 
			WHERE fpCreadenId = '$credenId' AND fpGender = '1'";
		$parent_male_result = $con->query($parent_male_count);
		if ($parent_male_result->num_rows > 0) {
			while($row_parent_male = $parent_male_result->fetch_assoc()){
				$parent_male = $row_parent_male['Parent_Male_Counts'];
			}
		}

		$parent_female = " "; 
		$parent_female_count = "SELECT COUNT('fpGender') as Parent_Female_Counts FROM fosterparent 
			WHERE fpCreadenId = '$credenId' AND fpGender = '2'";
		$parent_female_result = $con->query($parent_female_count);
		if ($parent_female_result->num_rows > 0) {
			while($row_parent_female = $parent_female_result->fetch_assoc()){
				$parent_female = $row_parent_female['Parent_Female_Counts'];
			}
		}

		$children_male = " "; 
		$children_male_count = "SELECT COUNT('chGender') as Children_Male_Counts FROM children 
			WHERE chFosterhomeId = '$fosterhome_id' AND chGender = '1'";
		$children_male_result = $con->query($children_male_count);
		if ($children_male_result->num_rows > 0) {
			while($row_children_male = $children_male_result->fetch_assoc()){
				$children_male = $row_children_male['Children_Male_Counts'];
			}
		}

		$children_female = " "; 
		$children_female_count = "SELECT COUNT('chGender') as Children_Female_Counts FROM children 
			WHERE chFosterhomeId = '$fosterhome_id' AND chGender = '2'";
		$children_female_result = $con->query($children_female_count);
		if ($children_female_result->num_rows > 0) {
			while($row_children_female = $children_female_result->fetch_assoc()){
				$children_female = $row_children_female['Children_Female_Counts'];
			}
		}

		$possible_adoptees = " ";
		$possible_adoptees_count = "SELECT COUNT('chStatus') as Possible_Adoptees FROM children 
			WHERE chFosterhomeId = '$fosterhome_id' AND chStatus = '1'";
		$possible_adoptees_result = $con->query($possible_adoptees_count);
		if ($possible_adoptees_result->num_rows > 0) {
			while($row_possible_adoptees = $possible_adoptees_result->fetch_assoc()){
				$possible_adoptees = $row_possible_adoptees['Possible_Adoptees'];
			}
		}

		$temporary = " ";
		$temporary_count = "SELECT COUNT('chStatus') as Temporary FROM children 
			WHERE chFosterhomeId = '$fosterhome_id' AND chStatus = '2'";
		$temporary_result = $con->query($temporary_count);
		if ($temporary_result->num_rows > 0) {
			while($row_temporary = $temporary_result->fetch_assoc()){
				$temporary = $row_temporary['Temporary'];
			}
		}

		$adopted = " ";
		$adopted_count = "SELECT COUNT('chStatus') as Adopted FROM children 
			WHERE chFosterhomeId = '$fosterhome_id' AND chStatus = '3'";
		$adopted_result = $con->query($adopted_count);
		if ($adopted_result->num_rows > 0) {
			while($row_adopted = $adopted_result->fetch_assoc()){
				$adopted = $row_adopted['Adopted'];
			}
		}

		$children_under_foster_care = " ";
		$children_under_foster_care_count = "SELECT COUNT('chStatus') as Children_Under_Foster_Care FROM children 
			WHERE chFosterhomeId = '$fosterhome_id' AND chStatus = '4'";
		$children_under_foster_care_result = $con->query($children_under_foster_care_count);
		if ($children_under_foster_care_result->num_rows > 0) {
			while($row_children_under_foster_care = $children_under_foster_care_result->fetch_assoc()){
				$children_under_foster_care = $row_children_under_foster_care['Children_Under_Foster_Care'];
			}
		}
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Foster Care Admin </h1>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-venus-double fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $parent_male; ?></div>
									<div>Parent Male!</div>
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
									<i class="fa fa-mars-double fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $parent_female; ?></div>
									<div>Parent Female!</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-venus fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $children_male; ?></div>
									<div>Children Male!</div>
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
									<i class="fa fa-mars fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $children_female; ?></div>
									<div>Children Female!</div>
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
									<i class="fa fa-group fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $possible_adoptees; ?></div>
									<div>Children Possible Adoptees!</div>
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
									<i class="fa fa-group fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $temporary; ?></div>
									<div>Children<br>Temporary!</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-group fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $adopted; ?></div> 
									<div>Children<br>Adopted!</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-black" style="background-color: #000; color: #fff;">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-group fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo $children_under_foster_care; ?></div>
									<div>Children under<br>foster care!</div>
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