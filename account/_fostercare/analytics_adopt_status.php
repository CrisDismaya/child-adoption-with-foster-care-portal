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

		// Status Status : possible_adoptees - temporary - adopted - children_under_foster_care
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
	<input type="hidden" value="<?php echo $possible_adoptees; ?>" id='possible_adoptees'/>
	<input type="hidden" value="<?php echo $temporary; ?>" id='temporary'/>
	<input type="hidden" value="<?php echo $adopted; ?>" id='adopted'/>
	<input type="hidden" value="<?php echo $children_under_foster_care; ?>" id='children_under_foster_care'/>

	<script src="js/canvasjs.min.js"></script>
	<script>
		window.onload = function() {
			var a = document.getElementById("possible_adoptees").value;
			var b = document.getElementById("temporary").value;
			var c = document.getElementById("adopted").value;
			var d = document.getElementById("children_under_foster_care").value;
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
						{ y: a, label: " Possible Adoptees"},
						{ y: b, label: " Temporary"},
						{ y: c, label: " Adopted"},
						{ y: d, label: " Children Under Foster Care"}
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
					<h1 class="page-header"> Adopt Status </h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6"> <!-- Pie Chart -->
					<div class="panel panel-default">
						<div class="panel-heading" style="height: 50px; background: #ffffff; border-bottom: 1px solid #f4f4f4; border-top: 3px solid #00c0ef;"><p>Adopt Status</p>
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