<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/addFosterhome.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Add Foster Home </h1>
				</div>
			</div>

			<form method="post" action="addFosterhome.php" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-body">
						
						<div class="container-fluid">
							<div class="col-lg-9">
								<label>Foster Home Name</label>
								<input type="text" name="FHName" id="FHName" class="form-control" placeholder="Foster Home Name" autocomplete="off" required><br>
							</div>
							<div class="col-lg-9">
								<label> Complete Address </label>
								<textarea name="FHAddress" id="FHAddress" rows="2" class="form-control" placeholder="Complete Address" style="resize: none;" required></textarea><br>
							</div>
							<div class="col-lg-4">
								<label> District </label>
								<?php
									include '../../security/connection.php';
									$query = mysqli_query($con, "SELECT * FROM district");
									$rowCount = $query->num_rows;
									?>
									<select name="FHDistrict" id="FHDistrict" class="form-control" required>
										<option hidden>Select District</option>
										<?php
										if($rowCount > 0){
											while($row = $query->fetch_assoc()){ 
												echo '<option value="'.$row['disId'].'">'.$row['disName'].'</option>';
											}
										}else{
											echo '<option value="">Country not available</option>';
										}
										?>
									</select><br>
							</div>
							<div class="col-lg-3">
								<label> Municipal </label>
								<select name="FHMunicpal" id="FHMunicpal" class="form-control" onchange="copyValue()" required>
									<option hidden>Select Municipal</option>
								</select><br>

							</div>
							<div class="col-lg-2">
								<label> Postal Code </label>
								<input type="text" name="FHPostal" id="FHPostal" class="form-control" placeholder="Postal Code" autocomplete="off" readonly required><br>
							</div>
							<div class="col-lg-9">
								<label> Email Address </label>
								<input type="email" name="FHEmail" id="FHEmail" class="form-control" placeholder="Email Address" autocomplete="off" required><br>
							</div>
							<div class="col-lg-9">
								<label> Contact Number </label>
								<input type="text" name="FHContact" id="FHContact" class="form-control" placeholder="Contact Number" maxlength="11" autocomplete="off" required><br>
							</div>
							<div class="col-lg-9">
								<label> Username </label>
								<input type="text" name="FHUsername" id="FHUsername" class="form-control" placeholder="Username" autocomplete="off" required><br>
							</div>
							<div class="col-lg-9">
								<label> Password </label>
								<input type="password" name="FHPassword" id="FHPassword" class="form-control" placeholder="Password" onkeyup="myFunction(event)" required>
								<span id="message" style="display: none;"></span><br>
							</div>
							<div class="col-lg-9">
								<label> Confirm Password </label>
								<input type="password" name="FHConPassword" id="FHConPassword"class="form-control" placeholder="Confirm Password" onkeyup="myFunction(event)"><br>
							</div>
							<div class="col-lg-12">
								<button type="submit" name="FHSubmit" id="FHSubmit" class="btn btn-lg btn-primary pull-right" disabled>
									Submit
								</button>
							</div>
						</div>

					</div>
				</div>
			</form>

		</div>
	</div>

	<?php include 'includes/script.php'; ?>
	<script>
		var FHContact = document.getElementById('FHContact');
		FHContact.onkeypress = FHContact.onpaste = checkInput;

		function checkInput(e) {
			var e = e || event;
				var char = e.type == 'keypress' 
					 ? String.fromCharCode(e.keyCode || e.which) 
					 : (e.clipboardData || window.clipboardData).getData('FHContact');
				if (/[^\d]/gi.test(char)) {
					return false;
				}
			}

			function myFunction(event) {
				var a = document.getElementById("FHPassword").value;
				var b = document.getElementById("FHConPassword").value;

				if(a.length == 0 && b.length == 0){
					document.getElementById("message").style.display = "none";
					document.getElementById("message").innerHTML = "";
					document.getElementById("FHSubmit").disabled = true;
				}
				else if(a == b){
					document.getElementById("message").style.display = "block";
					document.getElementById("message").style.color = "green";
					document.getElementById("FHSubmit").disabled = false;
					document.getElementById("message").innerHTML = "Password Matched";
				}
				else if(a == "" || b == ""){
					document.getElementById("message").style.display = "none";
					document.getElementById("message").innerHTML = "";
					document.getElementById("FHSubmit").disabled = true;
				}
				else{
					document.getElementById("message").style.display = "block";
					document.getElementById("message").style.color = "red";
					document.getElementById("FHSubmit").disabled = true;
					document.getElementById("message").innerHTML = "Password did not matched.";
				}
			}

			function copyValue() {
				var dropboxvalue = document.getElementById('FHMunicpal').value;
				document.getElementById('FHPostal').value = dropboxvalue;
			}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#FHDistrict').on('change',function(){
				var countryID = $(this).val();
				if(countryID){
					$.ajax({
						type:'POST',
						url:'action.php',
						data:'disId='+countryID,
						success:function(html){
							$('#FHMunicpal').html(html); 
						}
					}); 
				}
			});
		});
	</script>
</body>
</html>