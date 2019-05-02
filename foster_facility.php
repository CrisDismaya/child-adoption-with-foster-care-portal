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
				<h2>Facility</h2>
			</div>  

			<div class="col-lg-12">
				<div class="row">
					<?php 
						include 'security/connection.php';
						$credentialsId = $_GET['credentialsId'];

						$getDetails = "SELECT * FROM credentials
							JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
							JOIN district ON fosterhome.fhDistrict = district.disId
							JOIN municipal ON fosterhome.fhMunicipal = municipal.muniId
							WHERE credenId = '$credentialsId'";
						$disDetails = $con->query($getDetails);   

						if ($disDetails->num_rows > 0) {
							while($rowDetails = $disDetails->fetch_assoc()) {
								$fhName = $rowDetails['fhName'];
								$fhAddress = $rowDetails['disName'].", ".$rowDetails['fhAddress'].", ".$rowDetails['muniName'];
								$fhContact = $rowDetails['fhContact'];
								$fmEmail = $rowDetails['fmEmail'];
								$Orphanage_Started = $rowDetails['fhCreated'];
								$new_Orphanage_Started = date("F d, Y", strtotime($Orphanage_Started));
							}
						}
					?>

					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
								<center>
									<img class="img-responsive" src="images/orphanage.png" width="60%" style="margin-bottom: 5px;" />
								</center>
							</div>
							<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12" style="padding: 10px;">
								<label>Name : <i><?php echo $fhName; ?></i></label><br>
								<label>Address : <i><?php echo $fhAddress; ?></i></label><br>
								<label>Contact No. : <i><?php echo $fhContact; ?></i></label><br>
								<label>Email : <i><?php echo $fmEmail; ?></i></label><br>
								<label>Orphanage Started : <i><?php echo $new_Orphanage_Started; ?></i></label><br>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
								<?php 
									include 'security/connection.php';
									$credentialsId = $_GET['credentialsId'];

									$getDetails = "SELECT * FROM credentials
										JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
										JOIN district ON fosterhome.fhDistrict = district.disId
										JOIN municipal ON fosterhome.fhMunicipal = municipal.muniId
										JOIN facility ON credentials.credenId = facility.faCredenId
										WHERE credenId = '$credentialsId' AND faStatus = 1";
									$disDetails = $con->query($getDetails);   
									if ($disDetails->num_rows > 0) {
										while($rowDetails = $disDetails->fetch_assoc()) {
											$fhName = $rowDetails['fhName'];
											$fhAddress = $rowDetails['disName'].", ".$rowDetails['fhAddress'].", ".$rowDetails['muniName'];
											$fhContact = $rowDetails['fhContact'];
											$fmEmail = $rowDetails['fmEmail'];

											$faPhoto = $rowDetails['faPhoto'];
											$faName = $rowDetails['faName'];
											?>
											<div class="col-lg-3 col-md-4 col-sm-4 blog-content" style="margin-top: 10px;">
												<a href="#myZoom<?php echo $rowDetails['facilityId']; ?>" data-toggle="modal" >
													<div style="border: 2px solid; border-color: #000;">
														<center>
															<img src="account/_fostercare/<?php echo $faPhoto; ?>" width="250" height="200" style="margin-bottom: 5px; margin-top: 10px;" />
														</center>
														<h2 style="text-align: center;"><?php echo $faName; ?></h2>
													</div>
												</a>
											</div>
											<?php include('facility_zoom.php'); ?>
											<?php
										}
									}
									else {
										echo "
											<center>
												<h2> No Data </h2>											
											</center>
										";
									}
								?>
							</div>

			</div>
		</div>
	</section>	

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
</body>
</html>