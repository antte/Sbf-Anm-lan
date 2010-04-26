<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokningar</h1>
	</div>
	<table id="moduleIndex">
	<?php 
		$registrators = $this->requestAction('registrators/index');
		
		echo "<thead>";
		echo $html->tableHeaders(
			array('Förnamn', 'Efternamn', 'E-post', 'Telefonnummer', 'Bokningsnummer')
		);
		echo "</thead>";
			foreach ($registrators as $i => $registrator){ ?> 
				<tr >
				<?php 	
					foreach ($registrator as $modelName => $fields){
						foreach($fields as $fieldName => $fieldValue) {
							echo 	'<td>'. $html->link($fields[$fieldName],'putRegistrationInSessionAndRedirect/'. $registrator['Registrator']['number']) . '</td>';
						}
					}
					echo " </a></tr> ";
				
				}
			
			?>
	</table>
</div>