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

		// Children Gender : male - female
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
		
	?>
	<input type="hidden" value="<?php echo $children_male; ?>" id='Male'/>
	<input type="hidden" value="<?php echo $children_female; ?>" id='Female'/>
	<script src="js/canvasjs.min.js"></script>
	<script>
		window.onload = function() {
			var a = document.getElementById("Male").value;
			var b = document.getElementById("Female").value;
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				exportEnable: "true",
				title: { text: "" },
				data: [{
					type: "pie",
					startAngle: 240,
					yValueFormatString: "##0",
					showInLegend: "",
					indexLabel: "{label} - {y}",
					dataPoints: [
						{ y: a, label: " Male"},
						{ y: b, label: " Female"}
					]
				}]
			});
			chart.render();
		}
	</script>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Gender of Foster Child </h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6"> <!-- Pie Chart -->
					<div class="panel panel-default">
						<div class="panel-heading" style="height: 50px; background: #ffffff; border-bottom: 1px solid #f4f4f4; border-top: 3px solid #00c0ef;"><p>Gender of Foster Child</p>
						</div>
						<div class="panel-body">
							<div class="canvas-wrapper">
								<div class="large">
									<div id="chartContainer" style="height: 340px; width: 100%;"></div>
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