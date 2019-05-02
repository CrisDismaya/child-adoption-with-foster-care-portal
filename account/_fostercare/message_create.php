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

		$get = "SELECT * FROM fosterparent WHERE fpCreadenId = '$credenId' 
			AND msgStatus = 0";
		$dis = $con->query($get);   
		if ($dis->num_rows > 0) {
			while($rows = $dis->fetch_assoc()) {
				$fosterparentIds = $rows['fosterparentId'];
			}
		}
	?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Message Create </h1>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Create Message
					</div>
					
					<form method="post" action="message_create.php" enctype="multipart/form-data">
						<div class="panel-body">
							<div class="col-lg-6">
								<input type="hidden" name="credenId" value="<?php echo $credenId; ?>">
								<select name="msgFparentId" class="form-control" required>
									<option hidden> Select Foster Parent </option>
									<?php
										include '../../security/connection.php';
										$getFosterParent = "SELECT * FROM fosterparent WHERE fpCreadenId = '$credenId' 
											AND msgStatus = 0";
										$disFosterParent = $con->query($getFosterParent);   
										if ($disFosterParent->num_rows > 0) {
											while($row = $disFosterParent->fetch_assoc()) {
												$fosterparentId = $row['fosterparentId'];
												$fname = $row['fpFname']." ".$row['fpMname']." ".$row['fpLname'];
												echo "
													<option value=".$fosterparentId.">".$fname."</option>
												";
											}
										}
									?>
								</select><br>
							</div>
							<div class="col-lg-12">
								<textarea name="msgContent" class="form-control" placeholder="Message..." rows="7" required style="resize: none;"></textarea><br>

								<button type="submit" name="msgSend" class="btn btn-primary pull-right">
									Send
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
</body>
</html>