<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/news.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
	?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Add News </h1>
				</div>
			</div>

			<form method="post" action="news_add.php" enctype="multipart/form-data">
				<div class="container-fluid">
					<input type="hidden" name="nwCredenId" value="<?php echo $credenId; ?>">

					<div class="col-lg-8">
						<div class="panel panel-default">
							<div class="panel-body">

								<center><br>
									<a href="#" onclick="document.getElementById('Photo').click(); return false;">
										<img id="Photo" src="image/profile.png" width=200 height=200 alt="your image"
											style="border-radius:10%; border: 1px solid; border-color:  #000000;"/>
									</a></br></br>
									<input type="file" name="nwPhoto" id="Photo" accept="image/*" onchange="user_photo(this);" required/><br>
								</center>
								<label>Title</label><br>
								<input type="text" name="nwTitle" id="nwTitle" class="form-control" placeholder="News Title" 
									autocomplete="off" required><br>

								<label>Date</label><br>
								<input type="date" name="nwDate" id="nwDate" class="form-control" required><br>

								<label>Description</label><br>
								<textarea name="nwContent" id="nwContent" class="form-control" placeholder="Description" rows="5" style="resize: none;"></textarea><br>

								<button type="submit" name="nwSubmit" id="nwSubmit" class="btn btn-primary pull-right">
									Submit
								</button>
							</div>
						</div>
					</div>

			</form>
		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<script type="text/javascript">
		function user_photo(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#Photo')
					.attr('src', e.target.result)
					.width(230)
					.height(230);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
</body>
</html>