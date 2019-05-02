<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
    <?php include'_header.php'; ?>
    
	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>Foster Children
                    <select name="chartYearSelect" id="chartYearSelect" class="form-control pull-right" style="width:15%">
                        <option value="2019" selected>2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </h2>
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

            return $.ajax({
                type: 'POST',
                url: 'sql/chart.php',
                async: false,
                data: {
                    'getChartData': true,
                    'year': year
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

            return $.ajax({
                type: 'POST',
                url: 'sql/chart.php',
                async: false,
                data: {
                    'getChartData': true,
                    'year': year
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