<!-- element/people/index.ctp -->

<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
	<table id="moduleIndex">
		<?php 
			$people = $this->requestAction('people/index');
			echo "<thead>";
				echo $html->tableHeaders(array ('Förnamn', 'Efternamn', 'Roll', 'Bokningsnummer'));
			echo "</thead>";
			$k=0;
			$i=0;
			foreach ($people as $company){ 
				foreach ($company as $person){ ?> 
				<tr class="<?php echo $person['number']?>">
				<?php 	foreach ($person as $j => $row)
							echo 	'<td>'. $html->link($person[$j],'putRegistrationInSessionAndRedirect/'. $person['number']) . '</td>';
					echo " </a></tr> ";
			
					
				}
				$i++;
			}
		?>
	</table> 
</div>

