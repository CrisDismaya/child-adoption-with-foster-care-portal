<?php

	include '../../security/connection.php';

	

	if(isset($_POST['res'])){

		
				
	$sqls = "SELECT * FROM fosterparent 
			JOIN message ON fosterparent.fosterparentId = message.msgFparentId
		";
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
			?>

			<li class="right clearfix">
				<span class="chat-img pull-right">
					<img src="<?php echo $photo; ?>" width=70 height=70 class="img-circle" style="margin-left: 15px;"/>
				</span>

				<div class="chat-body clearfix">
					<div class="header">
						<small class=" text-muted">
							<i class="fa fa-clock-o fa-fw"></i> <?php echo $newmsgCreated; ?>
						</small>
						<strong class="pull-right primary-font"><?php echo $fnameM; ?></strong>
					</div>
					<p><?php echo $msgContent; ?></p>
				</div>
			</li>
			<?php
		}
	}

?>
</ul>

<?php }
?>