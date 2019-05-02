<div class="modal fade" id="myZoom<?php echo $rowDetails['facilityId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php 
				include 'security/connection.php';
				$sqlDisplpay = mysqli_query($con, "SELECT * FROM facility WHERE facilityId = '".$rowDetails['facilityId']."' ");
				$dissplay = mysqli_fetch_array($sqlDisplpay);

				$faPhoto = $dissplay['faPhoto'];
				$faName = $dissplay['faName'];
			?>
			<div class="modal-body">
				<center>
					<img src="account/_fostercare/<?php echo $faPhoto; ?>" class="img-thumbnail">
				</center>
			</div>
			<div class="modal-body">
				<center><p><b><?php echo $faName; ?></b></p></center>
			</div>
		</div>
	</div>
</div>