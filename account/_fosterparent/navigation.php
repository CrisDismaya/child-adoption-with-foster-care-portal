<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	 <?php include 'includes/head.php'; ?>
</head>

<body>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
		$credenAnyId = $_SESSION['credenAnyId'];
		$credenLevel = $_SESSION['credenLevel'];
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
					<i class="fa fa-user fa-fw"></i><b class="caret"></b>
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
					<li class="sidebar-search">
					   <!--  <center>
							<img src="../../image/asap.jpg" width=170>
						</center> -->
					</li>
					<li>
						<a href="index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> - <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="#"> - </a>
							</li>
							 <li>
								<a href="#"> - </a>
							</li>
						</ul>
					</li>
				   <!-- <li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> Manage Transaction <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
						   <li>
								<a href="#REVIEWREPORT"> Review Report </a>
							</li>
							 < <li>
								<a href="approval_list.php"> List of User </a>
							</li> 
						</ul>
					</li> -->
				</ul>

			</div>
		</div>
	</nav>

</div>
</body>
</html>
