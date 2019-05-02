<div class="modal fade" id="myEdit<?php echo $row['childrenId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 900px;">
		<div class="modal-content">

			<?php 
				include '../../security/connection.php';
				$sqlView = mysqli_query($con, "SELECT * FROM children WHERE childrenId = '".$row['childrenId']."'");
				$rowView=mysqli_fetch_array($sqlView);

				$children_id = $rowView['childrenId'];
				$children_photo = $rowView['chPhoto'];

				$children_fname = $rowView['chFname'];
				$children_mname = $rowView['chMname'];
				$children_lname = $rowView['chLname'];
				$children_age = $rowView['chAge'];

				$children_bday = $rowView['chBirthday'];
				$newchildren_bday = date("m/d/Y", strtotime($children_bday));

				$children_place = $rowView['chPlace'];

				$children_gender_id = $children_gender_name = "";
				if ($rowView['chGender'] == 1) {
					$children_gender_id = "1";
					$children_gender_name = "Male";
				} else {
					$children_gender_id = "2";
					$children_gender_name = "Female";
				}

				$children_national = $rowView['chNationality'];

				$children_status_id = $children_status_name = "";
				if ($rowView['chStatus'] == 1) {
					$children_status_id = "1";
					$children_status_name = "Possible Adoptees";
				} elseif ($rowView['chStatus'] == 2) {
					$children_status_id = "2";
					$children_status_name = "Temporary";
				} elseif ($rowView['chStatus'] == 3) {
					$children_status_id = "3";
					$children_status_name = "Adopted";
				} elseif ($rowView['chStatus'] == 4) {
					$children_status_id = "4";
					$children_status_name = "Children under foster care";
				} else {
					$children_status_id = "0";
					$children_status_name = "None";
				}

				$children_address = $rowView['chAddress'];
				$children_description = $rowView['chDescription'];
				$children_height = $rowView['chHieght'];
				$children_weight = $rowView['chWeight'];
				$children_hobbies = $rowView['chHobbies'];
			?>

			<div class="modal-header">
				Update Information
			</div>

			<form method="post" action="children_list.php" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="container-fluid">
						<input type="hidden" name="echildren_id" value="<?php echo $children_id; ?>">
						<table class="table table-borderless">
							<tr>
								<td colspan="3">
									<center><br>
										<a href="#" onclick="document.getElementById('Photo').click(); return false;">
											<img id="Photo" src="<?php echo $children_photo; ?>" width=200 height=200 alt="your image"
												style="border-radius:10%; border: 1px solid; border-color:  #000000;"/>
										</a></br></br>
										<input type="file" name="echildren_photo_new" id="Photo" accept="image/*" onchange="user_photo(this);"/><br>
										<input type="hidden" name="echildren_photo" value="<?php echo $children_photo?>">
									</center>
								</td>
							</tr>
							<tr>
								<td>
									<label>First Name</label><br>
									<input type="text" name="echildren_fname" class="form-control" placeholder="First Name" 
										value="<?php echo $children_fname; ?>" autocomplete="off" style="width: 100%;" required>
								</td>
								<td>
									<label>Middle Name</label><br>
									<input type="text" name="echildren_mname" class="form-control" placeholder="Middle Name" 
										value="<?php echo $children_mname; ?>" autocomplete="off" style="width: 100%;">
								</td>
								<td>
									<label>Last Name</label><br>
									<input type="text" name="echildren_lname" class="form-control" placeholder="Last Name" 
										value="<?php echo $children_lname; ?>" autocomplete="off" style="width: 100%;" required>
								</td>
							</tr>
							<tr>
								<td>
									<label>Age</label><br>
									<input type="text" name="echildren_age" class="form-control" placeholder="Age" 
										value="<?php echo $children_age; ?>" autocomplete="off" style="width: 100%;" required>
								</td>
								<td>
									<label>Birthday</label><br>
									<input type="text" name="echildren_bday" class="form-control" placeholder="Birthday" 
										value="<?php echo $newchildren_bday; ?>" autocomplete="off" style="width: 100%;" required>
								</td>
								<td>
									<label>Place of Birth</label><br>
									<input type="text" name="echildren_place" class="form-control" placeholder="Place of Birth" 
										value="<?php echo $children_place; ?>" autocomplete="off" style="width: 100%;">
								</td>
							</tr>
							<tr>
								<td>
									<label>Gender</label><br>
									<select name="echildren_gender" class="form-control" style="width: 100%;">
										<option value="<?php echo $children_gender_id; ?>"><?php echo $children_gender_name; ?></option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
								</td>
								<td>
									<label>Nationality</label><br>
									<input type="text" name="echildren_national" class="form-control" placeholder="Nationality" 
										value="<?php echo $children_national; ?>" autocomplete="off" style="width: 100%;">
								</td>
								<td>
									<label>Status</label><br>
									<select name="echildren_status" class="form-control" style="width: 100%;">
										<option value="<?php echo $children_status_id; ?>"><?php echo $children_status_name; ?></option>
										<?php
											include '../../security/connection.php';

											$childstatus_query = "SELECT * FROM childstatus";
											$childstatus_display = $con->query($childstatus_query);
											if ($childstatus_display->num_rows > 0) {
												while($row_status = $childstatus_display->fetch_assoc()) {
													$child_status_id = $row_status['childstatusId'];
													$child_status_name = $row_status['csName'];

													echo "
														<option value=". $child_status_id .">". $child_status_name ."</option>
													";
												}
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="1">
									<label>Address</label><br>
									<textarea name="echchildren_address" class="form-control" rows="5" placeholder="Address" style="resize: none;width: 100%;"><?php echo $children_address; ?></textarea>
								</td>
								<td colspan="2">
									<label>Description</label><br>
									<textarea name="echchildren_description" class="form-control" rows="5" placeholder="Address" style="resize: none;width: 100%;"><?php echo $children_description; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label> Height <span style="font-size: 10px;">(Inches)</span> </label>
									<input type="text" name="echildren_height" class="form-control" placeholder="Nationality" 
										value="<?php echo $children_height; ?>" autocomplete="off" style="width: 100%;">
								</td>
								<td>
									<label> Weight <span style="font-size: 10px;">(Pounds)</span> </label>
									<input type="text" name="echildren_weight" class="form-control" placeholder="Nationality" 
										value="<?php echo $children_weight; ?>" autocomplete="off" style="width: 100%;">
								</td>
								<td>
									<label> Hobbies </label>
									<input type="text" name="echildren_hobbies" class="form-control" placeholder="Nationality" 
										value="<?php echo $children_hobbies; ?>" autocomplete="off" style="width: 100%;">
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					<button type="submit" name="children_update" class="btn btn-warning">Update</button>
				</div>
			</form>

		</div>
	</div>
</div>

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

<script>
		function user_photo(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#children_photo')
					.attr('src', e.target.result)
					.width(170)
					.height(170);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}

		var echAge = document.getElementById('echAge');
		echAge.onkeypress = echAge.onpaste = checkInput;

		function checkInput(e) {
			var e = e || event;
			var char = e.type == 'keypress' 
				 ? String.fromCharCode(e.keyCode || e.which) 
				 : (e.clipboardData || window.clipboardData).getData('echAge');
			if (/[^\d]/gi.test(char)) {
				return false;
			}
		}

		function fun_AllowOnlyAmountAndDot(txt) {
			if(event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46) {
				var txtbx = document.getElementById(txt);
				var amount = document.getElementById(txt).value;
				var count = present = 0;

				if(amount.indexOf(".",present)||amount.indexOf(".",present+1));
				do {
					present = amount.indexOf(".",present);
					if(present!=-1) {
						count++;
						present++;
					}
				}
				while(present!=-1);

				if(present==-1 && amount.length==0 && event.keyCode == 46) {
					event.keyCode=0;
					return false;
				}

				if(count>=1 && event.keyCode == 46) {
					event.keyCode=0;
					return false;
				}

				if(count==1) {
					var lastdigits=amount.substring(amount.indexOf(".")+1,amount.length);
					if(lastdigits.length>=2) {
						event.keyCode=0;
						return false;
					}
				}
				return true;
			} else {
				event.keyCode=0;
				return false;
			}
		}
	</script>