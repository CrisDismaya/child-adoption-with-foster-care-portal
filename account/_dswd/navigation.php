<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<?php include 'security/secure.php'; ?>
</head>

<body>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
		$credenUser = $_SESSION['credenUser'];
	?>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<!-- Top Navigation: Right Menu -->
		<ul class="nav navbar-right navbar-top-links">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i> <?php echo $credenUser; ?> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
					</li>
				</ul>
			</li>
		</ul>

		<!-- Sidebar -->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">

				<ul class="nav" id="side-menu">
					<li class="sidebar-search" style="text-align: center;">
						<h3 style="text-transform: uppercase;"><b><?php echo $credenUser; ?></b></h3>
					</li>
					<li>
						<a href="index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> Manage Foster Care Unit <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="addFosterhome.php"> Add Foster Care Unit </a>
							</li>
							 <li>
								<a href="fosterHome_list.php"> List of Registered Foster Care Unit </a>
							</li>
						</ul>
					</li>
				   <li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> Manage Transaction <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
						   <li>
								<a href="reportFostercare.php"> Review Report </a>
							</li>
							 <!--  <li>
								<a href="approval_list.php"> List of User </a>
							</li>  -->
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> Manage Downloadable File <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="download_file.php"> Uplaod File </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> Manage Video <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<!-- <li>
								<a href="upload_video.php"> Uplaod Video </a>
							</li> -->
							<li>
								<a href="youtube_video.php"> Youtube Video </a>
							</li>
						</ul>
					</li>
				</ul>

			</div>
		</div>
	</nav>

</div>
</body>
</html>
