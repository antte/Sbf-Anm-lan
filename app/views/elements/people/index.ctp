<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
	<table id="moduleIndex">
		<?php 
			$people = $this->requestAction('people/index');
			echo "<thead>";
				echo $html->tableHeaders(array ('Bokningsnummer', 'Förnamn', 'Efternamn', 'Roll'));
			echo "</thead>";
			$k=0;
			$i=0;
			foreach ($people as $company){ 
				foreach ($company as $person){ ?> 
				<tr class ="<?php echo $person['number']; ?>" >
				<?php 	foreach ($person as $j => $row)
							echo 	'<td>'. $html->link($person[$j],'putRegistrationInSessionAndRedirect/'. $person['number'],array('class'=> ($i%2)? 'even ': 'odd ')) . '</td>';
					echo " </a></tr> ";
					$k++;
					
				}
				$i++;
			}
		?>
	</table> 
</div>

