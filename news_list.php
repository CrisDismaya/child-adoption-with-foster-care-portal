<?php
	include 'security/connection.php';
	$news_id = $_REQUEST["news_id"];
				
	$sql = "SELECT * FROM news WHERE nwStatus = '$news_id'";
	$result = $con->query($sql);																			
?>

<table class="table table-bordered">
	<tbody>
		<?php
			include'security/connection.php';  
			if ($result->num_rows > 0) {
				while($rowNews = $result->fetch_assoc()) {
				$newsId = $rowNews['newsId'];
				$nwPath = $rowNews['nwPath'];
				$nwTitle = $rowNews['nwTitle'];
				$nwDate = $rowNews['nwDate'];
				$newDate = date("M  d, Y", strtotime($nwDate));
				?>
				<tr>
					<td id="h1<?php echo $newsId; ?>" class='hide'><?php echo $newsId; ?></td>
				</tr>
				<?php
				}
			} else {
				echo"
					<center>
						<h3>No Available Data</h3>
					</center>
				";
			}
		?>
	</tbody>
</table>