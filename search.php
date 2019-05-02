<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>

	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>Search</h2><br>
				<!-- <input type="text" class="form-control" name=""> -->
			</div>  

			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-6">
						<form method="POST">
							<div class="input-group">
								<input type="text" id="search_data" class="form-control" autocomplete="off" placeholder="Search here..."/>
								<div class="input-group-btn">
									<button type="button" id="search" class="btn btn-success" style="background-color: #428bca; border-color: #428bca;">
										<span class="glyphicon glyphicon-search"></span> <b>Search</b>
									</button>
									<button type="button" id="refresh" class="btn btn-success">
										<span class="glyphicon glyphicon-refresh"></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<br>
				<table class="table table-bordered">
					<thead style="background-color: #000; color: #fff;">
						<tr>
							<th width="12%">Minucipal</th>
							<th width="22%">Foster Care Name</th>
							<th width="28%">Complete Address</th>
							<th width="15%">Contact Number</th>
							<th width="13%">Orphanage <br> Status</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody id="data" style="background-color: #EFEFEF;"></tbody>
				</table>
			</div>
		</div>
	</section>

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function(){
		DisplayData();
		
		$('#search').on('click', function(){
			if($('#search_data').val() == ""){
				alert("Please enter something first!");
			}else{
				var search = $('#search_data').val();
				var loader = $('<tr><td colspan = "6"><center>Searching....</center></td></tr>');
				$('#data').empty();
				loader.appendTo('#data');
				
				setTimeout(function(){
					loader.remove();
					$.ajax({
						url: 'search_seach.php',
						type: 'POST',
						data: {
							search: search
						},
						success: function(data){
							$('#data').html(data);
						}
					});
					
				}, 3000);	
			}
		});
		
		$('#refresh').on('click', function(){
			DisplayData();
		});
		
		
		function DisplayData(){
			$.ajax({
				url: 'search_data.php',
				type: 'POST',
				data: {
					res: 1
				},
				success: function(data){
					$('#data').html(data);
				}
			});
		}
	});
	</script>
</body>
</html>