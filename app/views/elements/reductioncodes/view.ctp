<!-- element/reduction_codes/index.ctp -->

<?php 
	$reduction_codes = $this->requestAction('reduction_codes/index');
?>

		<?php 
			if(!isset($reduction_codes[0])) {
				echo "Du har inga rabattkoder i din databas.";
			} else {
				echo '<table id="moduleIndex">';
				
				$headers = array_keys($reduction_codes[0]['ReductionCode']);
				echo "<thead>";
				echo $html->tableHeaders($headers);
				echo "</thead>
						<tbody>";
				foreach($reduction_codes as $reduction_code) {
					foreach($reduction_code as $code_value) {
						echo $html->tableCells($code_value);
					}
				}
				echo "</tbody>";
				echo "</table>";
			}
		
			
			
		?>