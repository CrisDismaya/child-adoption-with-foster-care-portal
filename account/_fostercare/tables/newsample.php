<?php

	include '../../security/connection.php';

	$salary_name2 = $_REQUEST["salary_name2"];
				
	$sql = "SELECT * FROM fosterparent 
			JOIN message ON fosterparent.fosterparentId = message.msgFparentId
			WHERE msgCredenId = '$salary_name2' AND msgArchive = 1 GROUP BY msgFparentId";
	$result = $con->query($sql);																			
?>

<table class="table table-bordered">
	<tbody>
		<?php
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$fosterId = $row['fosterparentId'];
					$messageId = $row['messageId'];
					$photo = $row['fpPtoho'];
					$name = $row['fpFname']." ".$row['fpLname'];
					$contant = $row['fpContact'];
					?>
					<tr>
						<td width='23%' style='border-right: none;'>
							<img src='<?php echo $photo; ?>' width=80 height=80 style='border: 1px solid; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);'/>
						</td>
						<td id=p2<?php echo $fosterId; ?> class='hide'><?php echo $fosterId; ?></td>
						<td>
							<strong class='primary-font'>Name : <i><?php echo $name; ?></i></strong><br>
							<strong class='primary-font'>Contact No. : <i><?php echo $contant; ?></i></strong><br>
							<button type='button' id='<?php echo $fosterId; ?>' class='btn btn-success' onclick='pass(this.id)'>
								<span class='fa fa-comments fa-fw'></span> Message
							</button>
							<a href='#myArchive<?php echo $messageId; ?>' class='btn btn-danger' data-toggle='modal'>
								<span class='fa fa-archive'></span> Archive
							</a>
							<?php include('..\message_archive.php'); ?>
						</td>
					</tr>
					<?php
				}
			}
		?>
	</tbody>
</table>