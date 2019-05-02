<?php error_reporting(0); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
	<?php include'sql/search.php'; ?>
</head>
<body class="homepage">
	<header id="header">
		<div class="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-xs-4">
						<!-- <div class="top-number"><p><i class="fa fa-phone-square"></i>  +0123 456 70 90</p></div> -->
						<!-- <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a> -->
					</div>
					<div class="col-sm-6 col-xs-8">
					   <div class="social">
							<ul class="social-share">
								<!-- <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://www.twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://www.skype.com/" target="_blank"><i class="fa fa-skype"></i></a></li>
								<li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li> -->
							</ul>
							<div class="search">
								<form role="form" >
									<!-- <input type="text" name="search" id="search" class="search-form" autocomplete="off" placeholder="Search"> -->
									<a href="search.php" class="btn">
										<i class="fa fa-search"></i>
									</a>
								</form>
						   </div>
					   </div>
					</div>
				</div>
			</div><!--/.container-->
		</div><!--/.top-bar-->

		<nav class="navbar navbar-inverse" role="banner">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a> -->
				</div>
				
				<div class="collapse navbar-collapse navbar-left">
					<ul class="nav navbar-nav">
						<?php
							include'security/connection.php';
							if (!empty($_SESSION['credenIds'])) {
								echo '
									<li class=""><a href="home.php">Home</a></li>
								';
							} else {
								echo '
									<li class=""><a href="index.php">Home</a></li>
								';
							}
						?>
						<!-- <li class="active"><a href="index.php">Home</a></li> -->
						<li><a href="download.php">Download</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Analytics <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="analytics_civil_status.php">Civil Status</a></li>
								<li><a href="analytics_gender_foster_child.php">Gender of Foster Child</a></li>
								<li><a href="analytics_children_adopt_status.php">Children Adopt Status</a></li>
								<li><a href="analytics_foster_children.php">Foster Child</a></li>
								<li><a href="analytics_foster_parent.php">Foster Parent	</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Management <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="fosterhome.php">Foster Home</a></li>
								<li><a href="news.php">News</a></li>
							</ul>
						</li>
						<?php
							include'security/connection.php';
							if (!empty($_SESSION['credenIds'])) {
								echo '
									<li><a href="report.php">My Account</a></li>
									<li><a href="logout.php">Logout</a></li>
								';
							} else {
								echo '
									<li><a href="login.php">Login</a></li>
								';
							}
						?>
					</ul>
				</div>
			</div><!--/.container-->
		</nav><!--/nav-->
		
	</header><!--/header-->
	<?php include'includes/script.php'; ?>
</body>
</html>