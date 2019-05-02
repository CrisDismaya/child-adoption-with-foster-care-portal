<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php 
		include '../../security/connection.php'; 

		// Children Adopt Status : possible adoptess - temporary - adopted - children under foster care
		$possible_adoptees = " ";
		$possible_adoptees_count = "SELECT COUNT('chStatus') as Possible_Adoptees FROM children 
			WHERE chStatus = '1'";
		$possible_adoptees_result = $con->query($possible_adoptees_count);
		if ($possible_adoptees_result->num_rows > 0) {
			while($row_possible_adoptees = $possible_adoptees_result->fetch_assoc()){
				$possible_adoptees = $row_possible_adoptees['Possible_Adoptees'];
			}
		}

		$temporary = " ";
		$temporary_count = "SELECT COUNT('chStatus') as Temporary FROM children 
			WHERE chStatus = '2'";
		$temporary_result = $con->query($temporary_count);
		if ($temporary_result->num_rows > 0) {
			while($row_temporary = $temporary_result->fetch_assoc()){
				$temporary = $row_temporary['Temporary'];
			}
		}

		$adopted = " ";
		$adopted_count = "SELECT COUNT('chStatus') as Adopted FROM children 
			WHERE chStatus = '3'";
		$adopted_result = $con->query($adopted_count);
		if ($adopted_result->num_rows > 0) {
			while($row_adopted = $adopted_result->fetch_assoc()){
				$adopted = $row_adopted['Adopted'];
			}
		}

		$children_under_foster_care = " ";
		$children_under_foster_care_count = "SELECT COUNT('chStatus') as Children_Under_Foster_Care FROM children 
			WHERE chStatus = '4'";
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
					showInLegend: "true",
					legendText: "{label}",
					showInLegend: "true",
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

	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>Children Adopt Status</h2>
			</div>

			<div class="row">
				<center>
				<div class="col-lg-12"> <!-- Pie Chart -->
					<div class="panel panel-default">
						<div class="panel-body" style="padding: 0;">
							<div class="canvas-wrapper">
								<div class="large">
									<div id="chartContainer" style="height: 340px; width: 100%;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</center>
			</div>

		</div>
	</section>

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
</body>
</html>