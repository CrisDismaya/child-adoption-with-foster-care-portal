<div class="modal fade" id="myPopup<?php echo $parent_report_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php 
				include '../../security/connection.php';
				$sqlDisplpay = mysqli_query($con, "SELECT * FROM parent_report 
					WHERE parent_report_id = '".$parent_report_id."'");
				$dissplay = mysqli_fetch_array($sqlDisplpay);

				$parent_report_photoname = $dissplay['prPhotoname'];
				$parent_report_date = $dissplay['prCreated'];
			?>
			<div class="modal-body">
				<img src="image/ParentReport/<?php echo $parent_report_photoname; ?>" class="img-thumbnail">
			</div>
		</div>
	</div>
</div>