<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Codenames</title>
	<style>
		table, td {
		  border: 1px solid black;
		}
	</style>
  </head>
  <body>
    <!-- page content -->
	<table>
	  <?php
	if (!isset($_GET["code"])) {
		echo 'Please copy the following link, open it and share it with the other team captain.';
		$code = '00000001111111122222222X' . rand(1,2);
		$code = str_shuffle($code);
		$code = substr($code, 0, 5) . '_' . substr($code, 5, 5) . '_' . substr($code, 10, 5) . '_' . substr($code, 15, 5) . '_' . substr($code, 20, 5);
		echo $_SERVER['SERVER_NAME'] . '/codenames.php?code=' . $code;
	}
  
	else {
			
		$bluecounter = 0;
		$redcounter = 0;
		
		$zeilen = explode("_", $_GET["code"]);
		
		foreach ($zeilen as $zeile) {
			echo '<tr>';
			for ($i = 0; $i < strlen($zeile); $i++) {
				echo '<td>';
				if ($zeile[$i] == '0'){
					echo 'N';
				}
				else if ($zeile[$i] == '1'){
					echo '<font color="red">R</font>';
					$redcounter = $redcounter + 1;
				}
				else if ($zeile[$i] == '2'){
					echo '<font color="blue">B</font>';
					$bluecounter++;
				}
				else if ($zeile[$i] == 'X'){
					echo '<b>X</b>';
				}
				echo '</td>';
			}
			echo '</tr>' . '<br>';
		}
	  ?>
	</table>
		
	<?php
	if ($redcounter > $bluecounter) {
		echo '<font color="red">Red begins</font>';
	}
	else if ($redcounter < $bluecounter) {
		echo '<font color="blue">Blue begins</font>';
	}
	else {
		echo 'Oops, wrong code!';
	}
		}
	?>
	
	

  </body>
</html>