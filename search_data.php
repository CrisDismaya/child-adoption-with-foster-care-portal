<?php
	include 'security/connection.php';
	if(ISSET($_POST['res'])){
		$query = mysqli_query($con, "SELECT * FROM fosterhome
			JOIN municipal ON fosterhome.fhMunicipal = municipal.muniId");
		while($fetch = $query->fetch_array()){

			$muniName = $fetch['muniName'];
			$fhName = $fetch['fhName'];
			$fhAddress = $fetch['fhAddress'];
			$fhContact = $fetch['fhContact'];

			$fhaccStatus = "";
			if ($fetch['fhaccStatus'] == 0) {
				$fhaccStatus = "<span style='color: #1E9F0D;'> <b>Active</b> </span>";
			} else {
				$fhaccStatus = "<span style='color: #9F0D17;'> <b>Inactive</b> </span>";
			}

			$fosterhomeId = $fetch['fosterhomeId'];
			?>
				<!-- <tr>
					<td><?php echo $muniName; ?></td>
					<td><?php echo $fhName; ?></td>
					<td><?php echo $fhAddress; ?></td>
					<td><?php echo $fhContact; ?></td>
					<td style='text-align: center;'><?php echo $fhaccStatus; ?></td>
					<td>
						<center>
							<a href="#search_deatils<?php echo $fosterhomeId; ?>" data-toggle="modal" class="btn btn-warning" type="button">
								<span class="fa fa-eye"></span> View
							</a>
						</center>
						<?php include('search_deatils.php'); ?>
					</td>
				</tr> -->
			<?php
		}
	}
?>
