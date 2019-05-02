<div class="modal fade" id="myEdit<?php echo $row['newsId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<?php 
				include '../../security/connection.php';
				$sqlView = mysqli_query($con, "SELECT * FROM news WHERE newsId = '".$row['newsId']."'");
				$rowView=mysqli_fetch_array($sqlView);

				$newsId = $rowView['newsId'];
				$nwPath = $rowView['nwPath'];

				$nwDate = $rowView['nwDate'];
				$newnwDate = date("m/d/Y", strtotime($nwDate));

				$nwTitle = $rowView['nwTitle'];
				$nwContent = $rowView['nwContent'];
			?>

			<div class="modal-header">
				<?php echo $nwTitle; ?>
			</div>

			<form method="post" action="news_list.php" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="container-fluid">
						<input type="hidden" name="newsId" value="<?php echo $newsId; ?>">
						<table class="table table-borderless">
							<tr>
								<td>
									<center><br>
										<a href="#" onclick="document.getElementById('Photo').click(); return false;">
											<img id="Photo" class="Photo" src="<?php echo $nwPath; ?>" width=200 height=200 alt="your image"
												style="border-radius:10%; border: 1px solid; border-color:  #000000;"/>
										</a></br></br>
										<input type="file" name="enwPhoto" id="Photo" accept="image/*" onchange="user_photo(this);"/><br>
										<input type="hidden" name="enwPath" value="<?php echo $nwPath?>">
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<label>Title</label><br>
									<input type="text" name="enwTitle" class="form-control" placeholder="News Title" 
										value="<?php echo $nwTitle; ?>" autocomplete="off" style="width: 100%;" required>
								</td>
							</tr>
							<tr>
								<td>
									<label>Date</label><br>
									<input type="text" name="enwDate" class="form-control" value="<?php echo $newnwDate; ?>" style="width: 100%;" required>
								</td>
							</tr>
							<tr>
								<td>
									<label>Description</label><br>
									<textarea name="enwContent" class="form-control" placeholder="Description" 
										rows="5" style="resize: none; width: 100%;"><?php echo $nwContent; ?></textarea>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="nwUpdate" class="btn btn-warning">Update</button>
				</div>
			</form>

		</div>
	</div>
</div>
<script type="text/javascript">
	function user_photo(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.Photo')
				.attr('src', e.target.result)
				.width(200)
				.height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
<style>
	.table-borderless > tbody > tr > td,
	.table-borderless > tbody > tr > th,
	.table-borderless > tfoot > tr > td,
	.table-borderless > tfoot > tr > th,
	.table-borderless > thead > tr > td,
	.table-borderless > thead > tr > th {
		border: none;
	}
</style>