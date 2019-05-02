<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/fosterParent.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];

		$getId = "SELECT * FROM credentials 
			JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
			WHERE credenId = '$credenId'";
		$disId = $con->query($getId);
		if ($disId->num_rows > 0) {
			while($rowId = $disId->fetch_assoc()) {
				$fosterhomeId = $rowId['fosterhomeId'];
			}
		}
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Add Foster Parent </h1>
				</div>
			</div>

			<form method="post" action="fosterParent_add.php" enctype="multipart/form-data">
				<input type="hidden" name="credenId" value="<?php echo $credenId; ?>">
				<input type="hidden" name="fosterhomeId" value="<?php echo $fosterhomeId; ?>">
				<div class="panel panel-default">
					<div class="panel-body">

						<div class="col-lg-12">
							<div class="form-group label-floating">
								<center>
									<br>
									<a href="#" onclick="document.getElementById('childrenPhoto').click(); return false;">
										<img id="children_photo" src="image/profile.png" width=180 height=180 alt="your image"
											style="border-radius:10%; border: 1px solid; border-color:  #000000;"/>
									</a></br></br>
									<input type="file" name="fpPhoto" id="childrenPhoto" accept="image/*" onchange="user_photo(this);" required/><br>
								</center>
							</div>
						</div>

						<div class="col-lg-4">
							<label> First Name </label>
							<input type="text" name="fpFname" id="fpFname" class="form-control" placeholder="First Name" autocomplete="off" required><br>
						</div>

						<div class="col-lg-4">
							<label> Middle Name </label>
							<input type="text" name="fpMname" id="fpMname" class="form-control" placeholder="Middle Name" autocomplete="off"><br>
						</div>

						<div class="col-lg-4">
							<label> Last Name </label>
							<input type="text" name="fpLname" id="fpLname" class="form-control" placeholder="Last Name" autocomplete="off" required><br>
						</div>

						<div class="col-lg-4">
							<label> Age </label>
							<input type="text" name="fpAge" id="fpAge" class="form-control" placeholder="Age" autocomplete="off" maxlength="2" required><br>
						</div>

						<div class="col-lg-4">
							<label> Birthday </label>
							<input type="date" name="fpBirthday" id="fpBirthday" class="form-control" placeholder="Birthday" autocomplete="off" required><br>
						</div>

						<div class="col-lg-4">
							<label> Gender </label>
							<select name="fpGender" id="fpGender" class="form-control" required>
								<option hidden> Select Gender </option>
								<option value="1"> Male </option>
								<option value="2"> Female </option>
							</select><br>
						</div>

						<div class="col-lg-4">
							<label> Civil Status </label>
							<select name="fpCivilStatus" id="fpCivilStatus" class="form-control">
								<option hidden> Select Civil Status </option>
								<option value="1"> Single </option>
								<option value="2"> Married </option>
								<option value="3"> Widowed </option>
								<option value="4"> Divorced </option>
							</select><br>
						</div>

						<div class="col-lg-4">
							<label> Contact Number </label>
							<input type="text" name="fpContact" id="fpContact" class="form-control" placeholder="Contact Number" autocomplete="off" maxlength="11" required><br>
						</div>

						<div class="col-lg-4">
							<label> Email Address </label>
							<input type="email" name="fpEmail" id="fpEmail" class="form-control" placeholder="Email Address" autocomplete="off" required><br>
						</div>

						<div class="col-lg-12">
							<label> Current Address </label>
							<textarea name="fpAddress" id="fpAddress" class="form-control" placeholder="Current Address" required style="resize: none;"></textarea><br>
						</div>

						<div class="col-lg-6">
							<label> Foster Child </label>
							<select name="fpChild" id="fpChild" class="form-control">
								<option hidden> Select Foster Child </option>
								<?php 
									include '../../security/connection.php'; 
									$getChildren = "SELECT * FROM children 
										JOIN childstatus ON children.chStatus = childstatus.childstatusId
										WHERE chFosterhomeId = '$fosterhomeId'AND chStatus = 1 AND chChildAdopt = 0";
									$disChildren = $con->query($getChildren);
									if ($disChildren->num_rows > 0) {
										while($rowC = $disChildren->fetch_assoc()) {
											$childrenId = $rowC['childrenId'];
											$children_name = $rowC['chFname']." ".$rowC['chMname']." ".$rowC['chLname'];

											echo "
												<option value=".$childrenId.">".$children_name."</option>
											";
										}
									}
								?>
							</select>
							<input type="hidden" name="fpChilds" id="fpChilds" class="form-control" placeholder="Foster Child" autocomplete="off" required><br>
						</div>

						<div class="col-lg-6">
							<label> Status Adopt </label>
							<select name="fpStatusAdopt" id="fpStatusAdopt" class="form-control" required>
								<option hidden> Select Status Adopt </option>
								<option value="2"> Temporary </option>
								<option value="3"> Permanent </option>
							</select><br>
						</div>

						<div class="col-lg-4">
							<label> Username </label>
							<input type="text" name="fpUsername" id="fpUsername" class="form-control" placeholder="Username" autocomplete="off" required><br>
						</div>

						<div class="col-lg-4">
							<label> Password </label>
							<input type="password" name="fpPassword" id="fpPassword" class="form-control" placeholder="Password" onkeyup="myFunction(event)" required>
							<span id="message" style="display: none;"></span><br>
						</div>

						<div class="col-lg-4">
							<label> Confirm Password </label>
							<input type="password" name="fpConPassword" id="fpConPassword" class="form-control" placeholder="Confirm Password" onkeyup="myFunction(event)"><br>
						</div>

						<div class="col-lg-12">
							<button type="submit" name="fpSubmit" id="fpSubmit" class="btn btn-lg btn-primary pull-right" disabled>
								Submit
							</button>
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

			function myFunction(event) {
				var a = document.getElementById("fpPassword").value;
				var b = document.getElementById("fpConPassword").value;

				if(a.length == 0 && b.length == 0){
					document.getElementById("message").style.display = "none";
					document.getElementById("message").innerHTML = "";
					document.getElementById("fpSubmit").disabled = true;
				}
				else if(a == b){
					document.getElementById("message").style.display = "block";
					document.getElementById("message").style.color = "green";
					document.getElementById("fpSubmit").disabled = false;
					document.getElementById("message").innerHTML = "Password Matched";
				}
				else if(a == "" || b == ""){
					document.getElementById("message").style.display = "none";
					document.getElementById("message").innerHTML = "";
					document.getElementById("fpSubmit").disabled = true;
				}
				else{
					document.getElementById("message").style.display = "block";
					document.getElementById("message").style.color = "red";
					document.getElementById("fpSubmit").disabled = true;
					document.getElementById("message").innerHTML = "Password did not matched.";
				}
			}
	</script>
</body>
</html>