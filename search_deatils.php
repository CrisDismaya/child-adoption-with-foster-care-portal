<div class="modal fade" id="search_deatils<?php echo $fosterhomeId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 800px;">
		<div class="modal-content">
			<?php
				include 'security/connection.php';
				$foster_details_query = mysqli_query($con, "SELECT * FROM fosterhome WHERE fosterhomeId = '".$fosterhomeId."'");
				$foster_details_display = mysqli_fetch_array($foster_details_query);
				$foster_home_id = $foster_details_display['fosterhomeId'];
				$foster_home_name = $foster_details_display['fhName'];
				$foster_home_address = $foster_details_display['fhAddress'];
				$foster_home_contact = $foster_details_display['fhContact'];
				$foster_home_email = $foster_details_display['fmEmail'];
			?>
			<div class="modal-header">
				<center><b>Details</b></center>
			</div>
			<div class="modal-body">
				<div class="container-fluid" style="margin-bottom: 20px;">
					<table class="table table-borderless">
						<tr>
							<td width="30%">
								<center>
									<img class="img-responsive" src="images/orphanage.png" width="70%" style="margin-bottom: 5px; border-radius: 5px;"/>
								</center>
							</td>
							<td>
								<label>Name : <span><?php echo $foster_home_name; ?></span></label><br>
								<label>Address : <span><?php echo $foster_home_address; ?></span></label><br>
								<label>Contact No. : <span><?php echo $foster_home_contact; ?></span></label><br>
								<label>Email : <span><?php echo $foster_home_email; ?></span></label><br>
							</td>
						</tr>
					</table>

					<h4><b>Orphanage Facility</b></h4><br>
					 <div class="row">
					<!--<div class="col-lg-4"> -->
					<?php
						include 'security/connection.php';
						$facility_details_orphanage = "SELECT * FROM credentials
							JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
							JOIN facility ON credentials.credenId = facility.faCredenId
							WHERE credenAnyid = '$foster_home_id' AND credenLevel = 2 AND faStatus = 1";
						$facility_details_display = $con->query($facility_details_orphanage);

						if ($facility_details_display->num_rows > 0) {
							while($row_facility_display = $facility_details_display->fetch_assoc()) {
								$credenId = $row_facility_display['credenId'];
								$faName = $row_facility_display['faName'];
								$faPhoto = $row_facility_display['faPhoto'];
								?>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<center>
												<img class="img-responsive" src="account/_fostercare/<?php echo $faPhoto; ?>" width="200" height="200" 
													style="margin-bottom: 5px;" />
											</center>
										</div>
									</div>
								</div>
								<?php
							}
						}
						else {
							echo "
								<center>
									<h2 style='color: #000;'> No Data </h2>
								</center>
							";
						}
					?>
					</div>
					<!-- </div> -->
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #428bca; border-color: #428bca; color: #fff;"><b>OK</b></button>
			</div>

		</div>
	</div>
</div>