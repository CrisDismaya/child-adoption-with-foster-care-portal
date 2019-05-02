<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/message.php'; ?>
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
					<h1 class="page-header"> sample </h1>
				</div>
			</div>

			<div class="col-lg-8">
			<form method='post' action='sample.php' enctype="multipart/form-data">
				<table class="table table-bordered" cellspacing="0">
					<thead style="background-color: #DCDCDC;">
						<tr>
							<th>Children</th>
							<th>Status Adopt</th>
						</tr>
					</thead>
					<tbody>
						 <tr>
						 	<td>
						 		<!-- <input type='text' id='first_name' name='first_name[]' class="form-control"/> -->
						 		<select name="first_name[]" id='first_name' class="form-control">
						 			<option hidden>Select Children</option>
						 			<?php
						 				include '../../security/connection.php'; 
										$getChildren = "SELECT * FROM children 
											JOIN childstatus ON children.chStatus = childstatus.childstatusId
											WHERE chFosterhomeId = '$fosterhomeId' AND chStatus = 1 AND chChildAdopt = 0";
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
						 	</td>
						 	<td>
						 		<!-- <input type='text' id='last_name' name='last_name[]' class="form-control" /> -->
						 		<select name="last_name[]" id="last_name" class="form-control" required>
									<option hidden> Select Status Adopt </option>
									<option value="2"> Temporary </option>
									<option value="3"> Permanent </option>
								</select>
						 	</td>
						 </tr>
					</tbody>
				</table>
				<button type="button" class="delete btn btn-danger">
					<span class="fa fa-minus"></span> Delete
				</button>
				<button type="button" class='addmore btn btn-primary'>
					<span class="fa fa-plus"></span> Add More
				</button>

				<button type='submit' name='submit' class='btn btn-success'>
					Submit
				</button>
			</form>
			</div>

			<?php
				if(isset($_POST['submit'])){
					// $last_name = $_POST['last_name'];

					foreach ($_POST['first_name'] as $first_name) {
						print_r($first_name."<br>");
					}
					foreach ($_POST['last_name'] as $last_name) {
						print_r("<br>"$last_name."<br>");
					}

					
				}
			?>

		</div> 
	</div>
	<!-- <input type='text' id='first_name"+i+"' name='first_name[]' class='form-control'/> -->


	<?php include '../includes/script.php'; ?>
	<script>
		$(".delete").on('click', function() {
			$('.case:checkbox:checked').parents("tr").remove();
		});

		var i=2;
		$(".addmore").on('click',function(){
			var data="<tr></td>";
			data +="<td><select id='first_name"+i+"' name='first_name[]' class='form-control'>";
			data +="<option hidden>Select Children</option>";
			data +="<?php include '../../security/connection.php'; ?>";
			data +="<?php $getChildren = "SELECT * FROM children JOIN childstatus ON children.chStatus = childstatus.childstatusId WHERE chStatus = 1 AND chChildAdopt = 0 AND chFosterhomeId = '$fosterhomeId'"; $disChildren = $con->query($getChildren); ?> ";
			data +="<?php if ($disChildren->num_rows > 0) { while($rowC = $disChildren->fetch_assoc()) { ?> ";
			data +="<?php $childrenId = $rowC['childrenId']; $children_name = $rowC['chFname']." ".$rowC['chMname']." ".$rowC['chLname']; ?> ";
			data +="<option value='<?php echo $childrenId; ?>'> <?php echo $children_name; ?> </option>";
			data +="<?php } } ?> ";
			data +="</select></td>";


			data +="<td><select name='last_name[]' id='last_name"+i+"' class='form-control' required>";
			data +="<option hidden> Select Status Adopt </option>";
			data +="<option value='2'> Temporary </option>";
			data +="<option value='3'> Permanent </option>";
			data +="</select></td></tr>";

			$('.table').append(data);
			i++;
		});

		function select_all() {
			$('input[class=case]:checkbox').each(function(){ 
				if($('input[class=check_all]:checkbox:checked').length == 0){ 
					$(this).prop("checked", false); 
				} else {
					$(this).prop("checked", true); 
				} 
			});
		}

	</script>
</body>
</html>