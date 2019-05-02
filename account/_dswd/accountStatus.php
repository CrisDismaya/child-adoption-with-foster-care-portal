<div class="modal fade" id="myStatus<?php echo $row['fosterhomeId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php 
				include '../../security/connection.php';
				$sqlView = mysqli_query($con, "SELECT * FROM fosterhome WHERE fosterhomeId = '".$row['fosterhomeId']."'");
				$rowView=mysqli_fetch_array($sqlView);

				$fosterhomeId = $rowView['fosterhomeId'];
				$fhName = $rowView['fhName'];
				$fhaccNo = $rowView['fhaccStatus'];
				$fhaccStatus = "";
				if ($rowView['fhaccStatus'] == 0) {
					$fhaccStatus = "<h3><b>Deactivate</b></h3>";
				} else {
					$fhaccStatus = "<h3><b>Activate</b></h3>";
				}
			?>

			<div class="modal-header">
				<?php echo $fhName; ?>
			</div>
			<form method="post" action="fosterHome_list.php" enctype="multipart/form-data">
				<div class="modal-body">
					<center>
						<input type="hidden" name="fosterhomeId" value="<?php echo $fosterhomeId; ?>">
						<input type="hidden" name="fosterStatusno" value="<?php echo $fhaccNo; ?>">
						<h3>Are you sure you want to <?php echo $fhaccStatus; ?></h3>
					</center>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="fhStatus" class="btn btn-primary">Yes</button>
				</div>
			</form>

		</div>
	</div>
</div>