<?php

	include 'security/connection.php';

	$children_list_id = $_REQUEST["children_list_id"];
				
	$sql = "SELECT * FROM children_adopt_by_parent WHERE adopt_parent_id = '$children_list_id' GROUP BY adopt_children_name";
	$result = $con->query($sql);																			
?>

<table class="table table-bordered">
	<thead style="background-color: #DCDCDC;">
		<th width="70%">Children Name</th>
		<th width="30%">Action</th>
	</thead>
	<tbody>
		<?php
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$adopt_id = $row['adopt_id'];
					$adopt_parent_id = $row['adopt_parent_id'];
					$adopt_children_id = $row['adopt_children_id'];
					$adopt_children_name = $row['adopt_children_name'];
					$adopt_children_bday = $row['adopt_children_bday'];
					?>
					<tr>
						<td><label><?php echo $adopt_children_name; ?></label></td>
						<td id="child_id<?php echo $adopt_id; ?>" class="hide"><?php echo $adopt_id; ?></td>
						<td>
							<center>
								<button type='button' id='<?php echo $adopt_id; ?>' class='btn btn-warning' onclick='pass(this.id)'>
									<span class='fa fa-arrow-right'></span>
								</button>
							</center>
						</td>
					</tr>
					<?php
				}
			}
			else {
				echo "
					<tr>
						<td colspan='2' style='text-align: center;'>
						<h3>No Data</h3>
						</td>
					</tr>
				";
			}
		?>
	</tbody>
</table>