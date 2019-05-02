<?php

	include '../../security/connection.php';

	

	if(isset($_POST['res'])){

	$parentID = $_POST['parent'];
				
	$sqls = "SELECT * FROM fosterparent 
			JOIN message ON fosterparent.fosterparentId = message.msgFparentId	
			JOIN credentials ON message.msgCredenId = credentials.credenId
			WHERE msgFparentId = '$parentID' AND msgStatused = 0";
	$results = $con->query($sqls);																			
?>

<ul class="chat">
<?php
	if ($results->num_rows > 0) {
		while($rowM = $results->fetch_assoc()) {
			$fosterparentId = $rowM['fosterparentId'];
			$photo = $rowM['fpPtoho'];
			$fnameM = $rowM['fpFname']." ".$rowM['fpLname'];
			$contact = $rowM['fpContact'];
			$msgFparentId = $rowM['msgFparentId'];
			$msgContent = $rowM['msgContent'];
			
			$msgCreated = $rowM['msgCreated'];
			$newmsgCreated = date("m/d/y - h:i A", strtotime($msgCreated));

			$chat_name = $rowM['credenUser'];

			// $pic = "";
			// if ($rowM['msgSendid'] == $parentID) {
			// 	$pic = $rowM['fpPtoho'];
			// } else {
			// 	$pic = "image/orphanage.png";
			// }
			?>
			
				<div class="row">
					<div class="col-lg-12">	<!--  style="border: 1px solid;"> -->
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #fff;">
								<span><b><?php echo $chat_name; ?></b> <i class="pull-right" style="font-size: 10px;"><em class="fa fa-clock-o fa-fw"></em><?php echo $newmsgCreated; ?></i></span>
								<p style="text-align: justify;"><?php echo $msgContent; ?></p>
							</div>
						</div>
					</div>
				</div>
			
				<!-- <li class="left clearfix">
					<span class="chat-img pull-left">
						<img src="<?php echo $photo; ?>" width=70 height=70 class="img-circle" />
					</span>

					<div class="chat-body clearfix">
						<div class="header">
							<strong class="primary-font"><?php echo $newmsgCreated; ?></strong>
							<small class="pull-right text-muted">
								<i class="fa fa-clock-o fa-fw"></i> <?php echo $newmsgCreated; ?>
							</small>
						</div>
						<p>
							<?php echo $newmsgCreated; ?>
						</p>
					</div>
				</li> -->
				<!-- <li class="right clearfix">
					<span class="chat-img pull-right">
						<img src="<?php echo $pic ?>" width=70 height=70 class="img-circle" style="margin-left: 15px;"/>
					</span>

					<div class="chat-body clearfix">
						<div class="header">
							<small class=" text-muted">
								<i class="fa fa-clock-o fa-fw"></i> <?php echo $newmsgCreated; ?>
							</small>
							<strong class="pull-right primary-font"><?php echo $creden_name; ?></strong>
						</div>
						<p><?php echo $msgContent; ?></p>
					</div>
				</li> -->
			<?php
		}
	}

?>
</ul>

<?php }
?>