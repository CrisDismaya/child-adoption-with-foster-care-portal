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
				<h2>Foster Home List</h2>
			</div>  

			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-4">
						<select class="form-control" id="catList">
							<option hidden>SELECT REGISTERED MINUCIPAL</option>
							<option value="0">ALL MINUCIPAL</option>
							<?php
								include 'security/connection.php';
								$Municipality = mysqli_query($con, "SELECT * FROM fosterhome 
									JOIN municipal ON fosterhome.fhMunicipal = municipal.muniId GROUP BY muniName");		
								while($rows = mysqli_fetch_array($Municipality)) {
								$catid = isset($_GET['category']) ? $_GET['category'] : 0;
								$selected = ($catid == $rows['muniId']) ? " selected" : "";
								$muniId = $rows['muniId'];
								$muniName = $rows['muniName'];
									echo "
										<option $selected value=". $muniId .">". $muniName ."</option>
									";
								}
							?>
						</select><br>
					</div>
				</div>
			</div>

			<div class="row">
				
					<?php
						include 'security/connection.php';
						$where = "";
						if(isset($_GET['category'])) {
							$catid=$_GET['category'];
							$where = "WHERE fosterhome.fhMunicipal = $catid";
						}

						$result=mysqli_query($con, "SELECT * FROM fosterhome 
							JOIN credentials ON fosterhome.fosterhomeId = credentials.credenAnyid
							JOIN municipal ON fosterhome.fhMunicipal = municipal.muniId
							$where AND fhStatus = 2 AND credenLevel = 2");

						if ($result->num_rows > 0) {
							// output data of each row
							while($row = mysqli_fetch_array($result)) {
								$credentialsId = $row['credenId'];
								$fhName = $row['fhName'];
								$fhAddress = $row['fhAddress'];
								$muniName = $row['muniName'];
								?>
								<div class="col-lg-4">
								<a href="foster_facility.php?credentialsId=<?php echo $credentialsId; ?>" style="cursor: pointer; ">
									<div class="panel panel-default" style="padding: 0; margin: 0;">
										<div class="panel-body" style="background-color: #fff;">
											<table class="table table-bordered" style="border: 2px solid #000;">
												<tr>
													<td>
														<center>
															<img class="img-responsive" src="images/orphanage.png" width="60%" style="margin-bottom: 5px;" />
														</center>
													</td>
												</tr>
												<tr>
													<td style="text-align: center";>
														<label style="font-size: 20px; color: #000;">	<b><?php echo $fhName; ?></b> </label>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</a>
								</div>
								<?php
							}
						} else {
							echo "
							<h3 style='text-align: center; '> No Data Available </h3>
							";
						}
					?>
				
			</div>

		</div>
	</section>

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#catList").on('change', function(){
				if($(this).val() == 0)
				{
					window.location = 'fosterhome.php';
				}
				else
				{
					window.location = 'fosterhome.php?category='+$(this).val();
				}
			});
		});
		function alert() {
			swal ("You need to Sign In!");
		}
	</script>
</body>
</html>