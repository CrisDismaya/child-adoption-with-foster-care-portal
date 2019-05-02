<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
	<SCRIPT language=JavaScript>
		function reload(form) {
			var val = form.cat.options[form.cat.options.selectedIndex].value;
			self.location='listFosterhome.php?cat=' + val ;
		}
	</script>
</head>
<body>
	<?php include 'navigation.php'; ?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> List of Registered Foster Home </h1>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="row">
					<?php
						@$cat=$_GET['cat']; 
						if(strlen($cat) > 0 and !is_numeric($cat)){
							echo "Data Error";
							exit;
						}

						$quer2="SELECT * FROM district"; 

						if(isset($cat) and strlen($cat) > 0){
							$quer="SELECT * FROM municipal where muniDistrict = $cat"; 
						} else {
							$quer="SELECT * FROM municipal"; 
						} 

						echo "<form method='post' name='f1' action='listFosterhome.php'>";
						echo "<div class='col-lg-3'>";
						echo "<select name='cat' onchange=\"reload(this.form)\" class='form-control'>";
						echo "<option value=''>Select one</option>";

						foreach ($con->query($quer2) as $noticia2) {
							if($noticia2['muniDistrict']==@$cat) {
								echo "<option selected value='$noticia2[muniDistrict]'>$noticia2[disName]</option>"."<BR>";
							} else {
								echo  "<option value='$noticia2[muniDistrict]'>$noticia2[disName]</option>";
							}
						}
						echo "</select><br>";
						echo "</div>";

						echo "<div class='col-lg-3'>";
						echo "<select name='subcat' class='form-control'>";
						echo "<option value=''>Select one</option>";
						foreach ($con->query($quer) as $noticia) {
							echo  "<option value='$noticia[muniName]'>$noticia[muniName]</option>";
						}
						echo "</select><br>";
						echo "</div>";

						echo "<div class='col-lg-3'>";
						echo "<input type='submit' value='Search' class='btn btn-primary'><br>";
						echo "</div>";
						echo "</form>";
					?>
				</div>
			</div>

			<div class="col-lg-12">
				<br>
				<div class="panel panel-default" >
					<div class="panel-body">
							
						<div class="container-fluid">
							<div class="dataTable_wrapper">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<th width="20%">Foster Care Name</th>
										<th width="20%">Complete Addresss</th>
										<th width="15%">Municipality</th>
										<th width="15%">Contact Number</th>
										<th width="15%">Account Status</th>
									</thead>

									<tbody>

									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
				responsive: true
			});
		});
	</script>
</body>
</html>