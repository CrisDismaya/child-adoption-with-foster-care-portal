<div class="modal fade" id="myEdit<?php echo $row['fosterparentId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 900px;">
		<div class="modal-content">
			<?php 
				include '../../security/connection.php';
				$sqlDisplpay = mysqli_query($con, "SELECT * FROM fosterparent 
					JOIN children ON fosterparent.fpChild = children.childrenId
					JOIN children_adopt_by_parent ON fosterparent.fosterparentId = children_adopt_by_parent.adopt_parent_id
					WHERE fosterparentId = '".$row['fosterparentId']."'");
				$dissplay = mysqli_fetch_array($sqlDisplpay);

				$fosterparentId = $row['fosterparentId'];
				$fpPtoho = $row['fpPtoho'];
				$fpFname = $row['fpFname'];
				$fpMname = $row['fpMname'];
				$fpLname = $row['fpLname'];
				
				$fpAge = $row['fpAge'];
				$fpBirthday = $row['fpBirthday'];
				$newfpBirthday = date("m/d/Y", strtotime($fpBirthday));

				$fpGender = $fpGenderId = "";
				if ($row['fpGender'] == 1) {
					$fpGenderId = 1;
					$fpGender = "Male"; } 
				else { 
					$fpGenderId = 2;
					$fpGender = "Female"; }

				$fpContact = $row['fpContact'];
				$fpEmail = $row['fpEmail'];
				$fpAddress = $row['fpAddress'];

				$fpChild = $row['fpChild'];
				$children_name = $row['chFname']." ".$row['chMname']." ".$row['chLname'];

				$fpStatusAdopt = $fpStatusAdoptId = "";
				if ($row['fpStatusAdopt'] == 2) {
					$fpStatusAdoptId =  2;
					$fpStatusAdopt = "Temporary"; }
				else { 
					$fpStatusAdoptId =  3;
					$fpStatusAdopt = "Permanent"; } 

				$fpAccountStatus = $fpAccountStatus = "";
				if ($row['fpAccountStatus'] == 0) {
					$fpAccountStatusId = 0;
					$fpAccountStatus = "Active"; }
				else{
					$fpAccountStatusId = 1;
					$fpAccountStatus = "Inctive"; }

				$fpUsername = $row['fpUsername'];
			?>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="exampleModalLabel"> <?php echo $fpFname." ".$fpMname." ".$fpLname; ?> </h5>
			</div>

			<form method="post" action="fosterParent_list.php" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="container-fluid">
						<table class="table table-borderless add_row_table">
							<tr><td width="1%"></td><td width="32%"></td><td width="32%"></td><td width="32%"></td></tr>
							<tr>
								<td colspan="4">
									<input type="hidden" name="efosterparentId" value="<?php echo $fosterparentId; ?>">
									<input type="hidden" name="efpUsername" value="<?php echo $fpUsername; ?>">
									<center>
										<br>
										<a href="#" onclick="document.getElementById('fpPhoto').click(); return false;">
											<img id="fp_photo" src="<?php echo $fpPtoho; ?>" width=180 height=180
												style="border-radius:10%; border: 1px solid; border-color:  #000000;"/>
										</a></br></br>
										<input type="file" name="efpPhoto" id="fpPhoto" accept="image/*" onchange="user_photo(this);"/>
										<input type="hidden" name="efp_photo" value="<?php echo $fpPtoho; ?>">
										<br>
									</center>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label> First Name </label><br>
									<input type="text" name="efpFname" id="fpFname" class="form-control" placeholder="First Name" autocomplete="off" style="width: 100%;" value="<?php echo $fpFname;?>" required>
								</td>
								<td>
									<label> Middle Name </label><br>
									<input type="text" name="efpMname" id="fpMname" class="form-control" placeholder="Middle Name" autocomplete="off" style="width: 100%;" value="<?php echo $fpMname; ?>">
								</td>
								<td>
									<label> Last Name </label><br>
									<input type="text" name="efpLname" id="fpLname" class="form-control" placeholder="Last Name" autocomplete="off" style="width: 100%;" value="<?php echo $fpLname; ?>" required>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label> Age </label><br>
									<input type="text" name="efpAge" id="fpAge" class="form-control" placeholder="Age" autocomplete="off" maxlength="2" style="width: 100%;" value="<?php echo $fpAge; ?>" required>
								</td>
								<td>
									<label> Birthday </label><br>
									<input type="text" name="efpBirthday" id="fpBirthday" class="form-control" placeholder="Birthday" autocomplete="off" style="width: 100%;" value="<?php echo $newfpBirthday; ?>" required>
								</td>
								<td>
									<label> Gender </label><br>
									<select name="fpGender" id="efpGender" class="form-control" style="width: 100%;">
										<option value="<?php echo $fpGenderId; ?>"><?php echo $fpGender; ?></option>
										<option value="1"> Male </option>
										<option value="2"> Female </option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label> Contact Number </label><br>
									<input type="text" name="efpContact" id="fpContact" class="form-control" placeholder="Contact Number" autocomplete="off" maxlength="11" style="width: 100%;" value="<?php echo $fpContact; ?>" required><br>
									<br>
									<label> Email Address </label><br>
									<input type="email" name="efpEmail" id="fpEmail" class="form-control" placeholder="Email Address" autocomplete="off" style="width: 100%;" value="<?php echo $fpEmail; ?>" required>
								</td>
								<td colspan="2">
									<label> Current Address </label><br>
									<textarea name="efpAddress" id="fpAddress" class="form-control" rows="5" placeholder="Current Address" required style="resize: none; width: 100%"><?php echo $fpAddress; ?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									
									<label> Foster Child </label><br>
									<input type="hidden" name="efpChild" id="fpChild" class="form-control" placeholder="Foster Child" autocomplete="off" style="width: 100%;" value="<?php echo $fpChild; ?>" readonly>

									<!-- <input type="text" name="efpChilds" id="fpChilds" class="form-control" placeholder="Foster Child" autocomplete="off" style="width: 86%; margin-bottom: 5px;" value="<?php echo $children_name; ?>" readonly> -->
									
									<?php 
										include '../../security/connection.php';
										$children_list_retrieve = "SELECT * FROM children_adopt_by_parent WHERE adopt_parent_id = '$fosterparentId' GROUP BY adopt_children_name";
										$list_retrieve = $con->query($children_list_retrieve);
										if ($list_retrieve->num_rows > 0) {
											while($list_row = $list_retrieve->fetch_assoc()) {
												$adopt_id = $list_row['adopt_id'];
												$adopt_parent_id = $list_row['adopt_parent_id'];
												$adopt_children_id = $list_row['adopt_children_id'];
												$adopt_children_name = $list_row['adopt_children_name'];
												?>
													<input type="hidden" name="Children_id[]" class="form-control" style="width: 100%; margin-bottom: 5px;" value="<?php echo $adopt_children_id; ?>" readonly>
													<input type="text" class="form-control" style="width: 100%; margin-bottom: 5px;" value="<?php echo $adopt_children_name; ?>" readonly>
												<?php
											}
										}
									?>
									
									<div id="TextBoxContainer"></div>
									
								</td>
								<td>
									<label> Status Adopt </label>
									<button type="button" id="btnAdd" class="addmore btn btn-xs btn-success pull-right">
										<span class="fa fa-plus"></span>
									</button><br>
									<select name="efpStatusAdopt" id="fpStatusAdopt" class="form-control" style="width: 100%;" required>
										<option value="<?php echo $fpStatusAdoptId; ?>"><?php echo $fpStatusAdopt; ?></option>
										<option value="2"> Temporary </option>
										<option value="3"> Permanent </option>
									</select>
								</td>
								<td>
									<label> Account Status </label><br>
									<select name="efpAccountStatus" id="fpAccountStatus" class="form-control" style="width: 100%;" required>
										<option value="<?php echo $fpAccountStatusId; ?>"><?php echo $fpAccountStatus; ?></option>
										<option value="0"> Active </option>
										<option value="1"> Inactive </option>
									</select>
								</td>
							</tr>
						</table>

						<!-- <div class="col-lg-8">
							<button type="button" class="remove btn btn-danger">
								<span class="fa fa-minus"></span> Delete
							</button>
							<button type="button" class='addmore btn btn-primary'>
								<span class="fa fa-plus"></span> Add More
							</button> 
						</div> -->
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					<button type="submit" name="fpUpdate" class="btn btn-warning">UPDATE</button>
				</div>
			</form>

		</div>
	</div>
</div>

<script>
	function user_photo(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#fp_photo')
				.attr('src', e.target.result)
				.width(170)
				.height(170);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	var fpAge = document.getElementById('fpAge');
	fpAge.onkeypress = fpAge.onpaste = checkInput;

	var fpContact = document.getElementById('fpContact');
	fpContact.onkeypress = fpContact.onpaste = checkInput;

	function checkInput(e) {
		var e = e || event;
		var char = e.type == 'keypress' 
			 ? String.fromCharCode(e.keyCode || e.which) 
			 : (e.clipboardData || window.clipboardData).getData('fpAge', 'fpContact');
		if (/[^\d]/gi.test(char)) {
			return false;
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