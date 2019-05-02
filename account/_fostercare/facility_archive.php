<div class="modal fade" id="myArchive<?php echo $row['facilityId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<?php 
				include '../../security/connection.php';
				$sqlView = mysqli_query($con, "SELECT * FROM facility WHERE facilityId = '".$row['facilityId']."'");
				$rowView=mysqli_fetch_array($sqlView);

				$facilityId = $rowView['facilityId'];
				$faPhoto = $rowView['faPhoto'];
				$faName = $rowView['faName'];
			?>

			<div class="modal-header">
				<?php echo $faName; ?>
			</div>
			<form method="post" action="facility_all.php" enctype="multipart/form-data">
				<div class="modal-body">
					<center>
						<input type="hidden" name="afacilityId" value="<?php echo $facilityId; ?>">
						<h3>Are you sure you want to archive <br><b>"<?php echo $faName; ?>"</b></h3>
					</center>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="faArchive" class="btn btn-primary">Yes</button>
				</div>
			</form>

		</div>
	</div>
</div>