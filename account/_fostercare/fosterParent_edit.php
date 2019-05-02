<div class="modal fade" id="myEdit<?php echo $row['fosterparentId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 900px;">
		<div class="modal-content">
			<?php 
				include '../../security/connection.php';

				$stmt = $db->prepare("SELECT * FROM fosterparent 
				JOIN children ON fosterparent.fpChild = children.childrenId
				JOIN children_adopt_by_parent ON fosterparent.fosterparentId = children_adopt_by_parent.adopt_parent_id
				WHERE fosterparentId = ? AND NOT adopt_children_status = 4 AND NOT adopt_children_status = 1");
				$stmt->execute([
					$row['fosterparentId']
                ]);
                
                $parentChildCount = $stmt->rowCount();

                if ($parentChildCount < 1) {
                    $stmt = $db->prepare("SELECT * FROM fosterparent WHERE fosterparentId = ?");
                    $stmt->execute([
                        $row['fosterparentId']
                    ]);
                    $row = $stmt->fetchAll();
                } else {
                    $row = $stmt->fetchAll();
                }
                
				$fosterparentId = $row[0]['fosterparentId'];
				$fpPtoho = $row[0]['fpPtoho'];
				$fpFname = $row[0]['fpFname'];
				$fpMname = $row[0]['fpMname'];
				$fpLname = $row[0]['fpLname'];
				
				$fpAge = $row[0]['fpAge'];
				$fpBirthday = $row[0]['fpBirthday'];
				$newfpBirthday = date("m/d/Y", strtotime($fpBirthday));

				$fpGender = $fpGenderId = "";
				if ($row[0]['fpGender'] == 1) {
					$fpGenderId = 1;
					$fpGender = "Male"; } 
				else { 
					$fpGenderId = 2;
					$fpGender = "Female"; }

				$fpContact = $row[0]['fpContact'];
				$fpEmail = $row[0]['fpEmail'];
				$fpAddress = $row[0]['fpAddress'];
				$fpUsername = $row[0]['fpUsername'];
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
						<table class="table table-borderless" id="fosterParent">
							<tr>
								<td colspan="4">
									<input type="hidden" id="efosterparentId" name="efosterparentId" value="<?php echo $fosterparentId; ?>">
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
								<td colspan="3">
									<table class="table table-borderless add_row_table children_update_table">
										<thead>
											<th colspan="2">Foster Child</th>
											<th><span>Status Adopt</span><button type="button" id="btnAdd" class="addmore btn btn-xs btn-success pull-right" onclick="addField(<?php echo $fosterparentId; ?>)">
												<span class="fa fa-plus"></span>
											</button></th>
                                        </thead>
                                        <?php if ($parentChildCount > 0): ?>
										<?php foreach ($row as $info): ?>
											<tr>
												<td colspan="2">
													<input type="hidden" name="efpChild" id="fpChild" class="form-control" placeholder="Foster Child" autocomplete="off" style="width: 100%;" value="<?php echo $info['adopt_children_id']; ?>" readonly>
													<input type="hidden" name="Children_id_add">	
													<input type="text" class="form-control" style="width: 100%; margin-bottom: 5px;" value="<?php echo $info['adopt_children_name']; ?>" readonly>
												</td>
												<td class="td-update-child">
													<input type="hidden" name="children_status_id_add">
													<input type="hidden" name="Children_id_udpate" value="<?php echo $info['adopt_children_id']; ?>">

													<select name="efpStatusAdopt" class="form-control fpStatusAdopt"
														<?php echo $info['adopt_children_status'] == 3 || $info['adopt_children_status'] == 4 ? 'disabled' : ''; ?>
														style="width: 100%; margin-bottom: 5px;" required>
														<option value="2" <?php echo $info['adopt_children_status'] == 2 ? 'selected' : ''; ?>> Temporary </option>
														<option value="3" <?php echo $info['adopt_children_status'] == 3 ? 'selected' : ''; ?>> Permanent </option>
													</select>
												</td>
												<td>
													<?php if ($info['adopt_children_status'] != 3 && $info['adopt_children_status'] != 4 ): ?>
														<button type="button" class="btn btn-warning btnUpdateChild"
															data-id="<?php echo $info['adopt_children_id']; ?>"
															data-status="<?php echo $info['adopt_children_status']; ?>">
															<span class='fa fa-edit'></span> Update
														</button>
													<?php endif; ?>
												</td>
											</tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
									</table>    
								</td>   
								<td>
									<label> Account Status </label><br>
									<select name="efpAccountStatus" id="fpAccountStatus" class="form-control" style="width: 100%;" required>
										<option value="0" <?php echo $row[0]['fpAccountStatus'] == 0 ? 'selected' : ''; ?>> Active </option>
										<option value="1" <?php echo $row[0]['fpAccountStatus'] == 1 ? 'selected' : ''; ?>> Inactive </option>
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