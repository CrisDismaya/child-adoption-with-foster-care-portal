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

		// Civil Status : single - married - widowed - divorced
		$single = "";
		$single_query = "SELECT COUNT('fpCivilStatus') AS single_status FROM fosterparent
			WHERE fpFosterparentId = '$fosterhome_id' AND fpCivilStatus = '1'";
		$single_result = $con->query($single_query);
		if ($single_result->num_rows > 0) {
			while($row_single = $single_result->fetch_assoc()){
				$single = $row_single['single_status'];
			}
		}

		$married = "";
		$married_query = "SELECT COUNT('fpCivilStatus') AS married_status FROM fosterparent
			WHERE fpFosterparentId = '$fosterhome_id' AND fpCivilStatus = '2'";
		$married_result = $con->query($married_query);
		if ($married_result->num_rows > 0) {
			while($row_married = $married_result->fetch_assoc()){
				$married = $row_married['married_status'];
			}
		}

		$widowed = "";
		$widowed_query = "SELECT COUNT('fpCivilStatus') AS widowed_status FROM fosterparent
			WHERE fpFosterparentId = '$fosterhome_id' AND fpCivilStatus = '3'";
		$widowed_result = $con->query($widowed_query);
		if ($widowed_result->num_rows > 0) {
			while($row_widowed = $widowed_result->fetch_assoc()){
				$widowed = $row_widowed['widowed_status'];
			}
		}

		$divorced = "";
		$divorced_query = "SELECT COUNT('fpCivilStatus') AS divorced_status FROM fosterparent
			WHERE fpFosterparentId = '$fosterhome_id' AND fpCivilStatus = '4'";
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
					showInLegend: "",
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

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Civil Status </h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6"> <!-- Pie Chart -->
					<div class="panel panel-default">
						<div class="panel-heading" style="height: 50px; background: #ffffff; border-bottom: 1px solid #f4f4f4; border-top: 3px solid #00c0ef;"><p>Civil Status of Parent</p>
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