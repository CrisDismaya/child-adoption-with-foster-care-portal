<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
	<?php include'sql/signin.php'; ?>
</head>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php include'_slider1.php'; ?>
	
	<section id="feature" style="background-color: #fff;">
		<div class="container">

			<div class="row">
				<div class="features">

					<div class="col-md-6 col-md-offset-3">
						<div class="panel panel-default" style="border: 1px solid;">
							<div class="panel-heading" style="text-align: center;">
								<label style="font-size: 20px;">Login</label>
							</div>

							<form method="post" action="login.php" enctype="multipart/form-data">
								<div class="panel-body" style="background-color: #fff;">
									<div class="container-fluid">
										<table class="table table-borderless">
											<tr>
												<td>
													<label>Username</label><br>
													<input type="text" name="username" class="form-control" autocomplete="off" placeholder="Username" required>
												</td>
											</tr>
											<tr>
												<td>
													<label>Password</label><br>
													<input type="password" name="password" class="form-control" placeholder="Password" required>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<div class="panel-footer" style="text-align: right;">
									<button type="submit" name="signin" class="btn btn-primary">
										<span class="glyphicon glyphicon-log-in"></span> Login
									</button>
								</div>
							</form>

						</div>
					</div>

				</div><!--/.services-->
			</div><!--/.row-->    
		</div><!--/.container-->
	</section><!--/#feature-->

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
</body>
</html>