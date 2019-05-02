<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/children.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenIds = $_SESSION['credenId'];

		$getIds = "SELECT * FROM credentials 
			JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
			WHERE credenId = '$credenIds'";
		$disIds = $con->query($getIds);
		if ($disIds->num_rows > 0) {
			while($rowIds = $disIds->fetch_assoc()) {
				$fosterhomeIds = $rowIds['fosterhomeId'];
			}
		}
	?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Add Children </h1>
				</div>
			</div>

			<form method="post" action="children_add.php" enctype="multipart/form-data">
				<input type="hidden" name="credenId" value="<?php echo $credenIds; ?>">
				<input type="hidden" name="fosterhomeId" value="<?php echo $fosterhomeIds; ?>">

				<div class="panel panel-default">
					<div class="panel-body">
						<div class="container-fluid">

							<div class="col-lg-12">
								<div class="form-group label-floating">
									<center>
										<br>
										<a href="#" onclick="document.getElementById('childrenPhoto').click(); return false;">
											<img id="children_photo" src="image/profile.png" width=180 height=180 alt="your image"
												style="border-radius:10%; border: 1px solid; border-color:  #000000; margin-bottom: 5px;"/>
										</a>
										<input type="file" name="chPhoto" id="childrenPhoto" accept="image/*" onchange="user_photo(this);" required/><br>
									</center>
								</div>
							</div>

							<div class="col-lg-4">
								<label> First Name </label>
								<input type="text" name="chFname" id="chFname" class="form-control" placeholder="First Name" autocomplete="off" required><br>
							</div>

							<div class="col-lg-4">
								<label> Middle Name </label>
								<input type="text" name="chMname" id="chMname" class="form-control" placeholder="Middle Name" autocomplete="off"><br>
							</div>

							<div class="col-lg-4">
								<label> Last Name </label>
								<input type="text" name="chLname" id="chLname" class="form-control" placeholder="Last Name" autocomplete="off" required><br>
							</div>

							<div class="col-lg-4">
								<label> Age </label>
								<input type="text" name="chAge" id="chAge" class="form-control" placeholder="Age" autocomplete="off" maxlength="2" required><br>
							</div>

							<div class="col-lg-4">
								<label> Birthday </label>
								<input type="date" name="chBirthday" id="chBirthday" class="form-control" placeholder="Birthday" autocomplete="off" required><br>
							</div>

							<div class="col-lg-4">
								<label> Place of Birth </label>
								<input type="text" name="chPlace" id="chPlace" class="form-control" placeholder="Place of Birth" autocomplete="off"><br>
							</div>

							<div class="col-lg-4">
								<label> Gender </label>
								<select name="chGender" id="chGender" class="form-control" required>
									<option hidden> Select Gender </option>
									<option value="1"> Male </option>
									<option value="2"> Female </option>
								</select><br>
							</div>

							<div class="col-lg-4">
								<label> Nationality </label>
								<input type="text" name="chNationality" id="chNationality" class="form-control" placeholder="Nationality" autocomplete="off"><br>
							</div>

							<div class="col-lg-4">
								<label> Status </label>
								<select name="chStatus" id="chStatus" class="form-control" required>
									<option hidden> Select Status </option>
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
								</select><br>
							</div>

							<div class="col-lg-6">
								<label> Address </label>
								<textarea name="chAddress" class="form-control" rows="5" placeholder="Address" style="resize: none;"></textarea><br>
							</div>

							<div class="col-lg-6">
								<label> Description </label>
								<textarea name="chDescription" class="form-control" rows="5" placeholder="Description" style="resize: none;"></textarea><br>
							</div>

							<div class="col-lg-4">
								<label> Height <span style="font-size: 10px;">(Inches)</span> </label>
								<input type="text" name="chHieght" id="chHieght" class="form-control" placeholder="Hieght" autocomplete="off" onkeypress='return fun_AllowOnlyAmountAndDot(this.id);'><br>
							</div>

							<div class="col-lg-4">
								<label> Weight <span style="font-size: 10px;">(Pounds)</span> </label>
								<input type="text" name="chWeight" id="chWeight" class="form-control" placeholder="Weight" autocomplete="off" onkeypress='return fun_AllowOnlyAmountAndDot(this.id);'><br>
							</div>

							<div class="col-lg-4">
								<label> Hobbies </label>
								<input type="text" name="chHobbies" id="chHobbies" class="form-control" placeholder="Hobbies (ex. basketball, tennis)" autocomplete="off"><br>
							</div>

							<div class="col-lg-12">
								<button type="submit" name="chSubmit" id="chSubmit" class="btn btn-lg btn-primary pull-right">
									Submit
								</button>
							</div>

						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
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

		var chAge = document.getElementById('chAge');
		chAge.onkeypress = chAge.onpaste = checkInput;

		function checkInput(e) {
			var e = e || event;
			var char = e.type == 'keypress' 
				 ? String.fromCharCode(e.keyCode || e.which) 
				 : (e.clipboardData || window.clipboardData).getData('chAge');
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
</body>
</html>