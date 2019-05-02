<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php 
		include '../../security/connection.php'; 

		// Children Gender : male - female
		$children_male = " "; 
		$children_male_count = "SELECT COUNT('chGender') as Children_Male_Counts FROM children 
			WHERE chGender = '1'";
		$children_male_result = $con->query($children_male_count);
		if ($children_male_result->num_rows > 0) {
			while($row_children_male = $children_male_result->fetch_assoc()){
				$children_male = $row_children_male['Children_Male_Counts'];
			}
		}

		$children_female = " "; 
		$children_female_count = "SELECT COUNT('chGender') as Children_Female_Counts FROM children 
			WHERE chGender = '2'";
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
					showInLegend: "true",
					legendText: "{label}",
					showInLegend: "true",
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

	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>Gender of Foster Child</h2>
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