<div class="modal fade" id="myPopup<?php echo $row['facilityId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php 
				include '../../security/connection.php';
				$sqlDisplpay = mysqli_query($con, "SELECT * FROM facility WHERE facilityId = '".$row['facilityId']."' ");
				$dissplay = mysqli_fetch_array($sqlDisplpay);

				$faPhoto = $dissplay['faPhoto'];
				$faName = $dissplay['faName'];
			?>
			<div class="modal-body">
				<img src="<?php echo $faPhoto; ?>" class="img-thumbnail">
			</div>
			<div class="modal-footer">
				<center><p><b><?php echo $faName; ?></b></p></center>
			</div>
		</div>
	</div>
</div>