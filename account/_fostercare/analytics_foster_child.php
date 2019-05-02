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
    ?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Foster Child </h1>
				</div>
            </div>
            
            <input type="hidden" id="fosterhome_id" value="<?php echo $fosterhome_id; ?>">
            

			<div class="row">
                <div class="col-md-12"> <!-- Pie Chart -->
                     <div class="panel-heading" style="height: 50px; background: #ffffff; border-bottom: 1px solid #f4f4f4; border-top: 3px solid #00c0ef;">
                        <p>Foster Child
                        <select name="chartYearSelect" id="chartYearSelect" class="form-control pull-right" style="width:15%">
                            <option value="2019" selected>2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select></p>
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
	
    <?php include '../includes/script.php'; ?>
    <script src="js/canvasjs.min.js"></script>
	<script>   
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: { text: "" },
            axisY : { title: "Number of Children" },
            data: [{
                type: "line",
                dataPoints: JSON.parse(chartData().responseText)
            }]
        });
        chart.render();

        function chartData() {
            var year = '2019';
            var fhid = $('#fosterhome_id').val();

            return $.ajax({
                type: 'POST',
                url: './sql/chart.php',
                async: false,
                data: {
                    'getChartData': true,
                    'year': year,
                    'fhid': fhid
                },
                success: function(response) {
                    return(response);
                },
                error: function(xhr, thrownError) {
                    console.log('error', xhr.status, thrownError);
                }
            });
        }

        function updateChart(data) {
            chart.options.data[0].dataPoints = data;
            chart.render();
        }

        $(document).on('change', '#chartYearSelect', function() {
            var year = $(this).val();
            var fhid = $('#fosterhome_id').val();

            return $.ajax({
                type: 'POST',
                url: './sql/chart.php',
                async: false,
                data: {
                    'getChartData': true,
                    'year': year,
                    'fhid': fhid
                },
                success: function(response) {
                    updateChart(JSON.parse(response));
                },
                error: function(xhr, thrownError) {
                    console.log('error', xhr.status, thrownError);
                }
            });
        });
	</script>
</body>
</html>
