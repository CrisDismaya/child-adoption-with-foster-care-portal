<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php';?>
	<?php
		include '../security/connection.php';
		require '../security/common.php';

		if(isset($_POST['login'])){
			$user = $_POST['email'];
			$pass =  $_POST['password'];

			$sql = "SELECT * FROM credentials WHERE credenUser = '$user' AND crendeStatus = 0";
			$result = $con->query($sql);

			if($result->num_rows > 0){
				while($row= $result->fetch_assoc()){
					if(password_verify($pass, $row['credenPass'])){
						$_SESSION['credenId'] = $row['credenId'];
						$_SESSION['credenAnyId'] = $row['credenAnyid'];
						$_SESSION['credenUser'] = $row['credenUser'];   
						$_SESSION['credenLevel'] = $row['credenLevel'];

						if ($_SESSION['credenLevel'] == 1) {
							header("Location: _dswd/index.php");
							die("Redirecting to: _dswd/index"); } 
						else if ($_SESSION['credenLevel'] == 2) {
							header("Location: _fostercare/index.php");
							die("Redirecting to: _fostercare/index"); }
						// else if ($_SESSION['credenLevel'] == 3) {
						// 	unset($row['credenId']);
						// 	unset($row['credenUser']);
						// 	unset($row['credenPass']);
						// 	header("Location: _fosterparent/index.php");
						// 	die("Redirecting to: _fosterparent/index"); } 
					}
				} ?>
					<!-- <script> alert ('Welcome <?php echo $_SESSION['credenUser']?>'); </script> -->
				<?php
				} else { ?>
					<script> alert ('Invalid Account'); </script>
				<?php

			}
			$con->close();
		}
	?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading" style="font-size: 20px;">
						<label class="panel-title">Please Sign In </label> 
					</div>
					<div class="panel-body">
						<form role="form" method="POST">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" name="email" type="text" autocomplete="off" required>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" required>
								</div>
								<!-- Change this to a button or input when using this as a form -->
								<!-- <a href="#" name="login" class="btn btn-lg btn-success btn-block">Login</a> -->
								<button type="submit"  name="login" class="btn btn-lg btn-primary btn-block text-uppercase"/>Sign in</button>
							</fieldset>
						</form>
					</div>
					<div class="panel-footer" style="font-size: 10px; text-align: center; ">
						 <label><i> Adoption Center </i></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>