<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php 
		include '../../security/connection.php'; 

		// Civil Status : single - married - widowed - divorced
		$single = "";
		$single_query = "SELECT COUNT('fpCivilStatus') AS single_status FROM fosterparent
			WHERE fpCivilStatus = '1'";
		$single_result = $con->query($single_query);
		if ($single_result->num_rows > 0) {
			while($row_single = $single_result->fetch_assoc()){
				$single = $row_single['single_status'];
			}
		}

		$married = "";
		$married_query = "SELECT COUNT('fpCivilStatus') AS married_status FROM fosterparent
			WHERE fpCivilStatus = '2'";
		$married_result = $con->query($married_query);
		if ($married_result->num_rows > 0) {
			while($row_married = $married_result->fetch_assoc()){
				$married = $row_married['married_status'];
			}
		}

		$widowed = "";
		$widowed_query = "SELECT COUNT('fpCivilStatus') AS widowed_status FROM fosterparent
			WHERE fpCivilStatus = '3'";
		$widowed_result = $con->query($widowed_query);
		if ($widowed_result->num_rows > 0) {
			while($row_widowed = $widowed_result->fetch_assoc()){
				$widowed = $row_widowed['widowed_status'];
			}
		}

		$divorced = "";
		$divorced_query = "SELECT COUNT('fpCivilStatus') AS divorced_status FROM fosterparent
			WHERE fpCivilStatus = '4'";
		$divorced_result = $con->query($divorced_query);
		if ($divorced_result->num_rows > 0) {
			while($row_divorced = $divorced_result->fetch_assoc()){
				$divorced = $row_divorced['divorced_status'];
			}
		}
	?>
	<input type="hidden" value="<?php echo $single; ?>" id='single'/>
	<input type="hidden" value="<?php echo $married; ?>" id='married'/>
	<input type="hidden" value="<?php echo $widowed; ?>" id='widowed'/>
	<input type="hidden" value="<?php echo $divorced; ?>" id='divorced'/>

	<script src="js/canvasjs.min.js"></script>
	<script>
		window.onload = function() {
			var a = document.getElementById("single").value;
			var b = document.getElementById("married").value;
			var c = document.getElementById("widowed").value;
			var d = document.getElementById("divorced").value;
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
					indexLabel: "{label} - {y}",
					dataPoints: [
						{ y: a, label: " Single"},
						{ y: b, label: " Married"},
						{ y: c, label: " Widowed"},
						{ y: d, label: " Divorced"}
					]
				}]
			});
			chart.render();
		}
	</script>
	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>Civil Status</h2>
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