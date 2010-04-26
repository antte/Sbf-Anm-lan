<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
	<table id="registrations">
		<?php 
			$people = $this->requestAction('people/index');
			echo $html->tableHeaders(array ('Bokningsnummer', 'Förnamn', 'Efternamn', 'Roll'));
			$k=0;
			$i=0;
			foreach ($people as $company){ 
				foreach ($company as $person){ ?> 
				<tr class ="<?php 	echo ($k%2)? 'even': 'odd';
									echo ($k%2)? 'company': '';
							?>" >
				<?php 	echo 	'<td>'. $html->link($person['number'],'putRegistrationInSessionAndRedirect/'. $person['number'],array('class'=> ($i%2)? 'even': 'odd')) . '</td>';
						echo	'<td>'.	$html->link($person['first_name'],'putRegistrationInSessionAndRedirect/'. $person['number'],array('class'=> ($i%2)? 'even': 'odd')) . '</td>';
						echo	'<td>'.	$html->link($person['last_name'],'putRegistrationInSessionAndRedirect/'. $person['number'],array('class'=> ($i%2)? 'even': 'odd')) . '</td>';
						echo	'<td>'.	$html->link($person['role'],'putRegistrationInSessionAndRedirect/'. $person['number'],array('class'=> ($i%2)? 'even': 'odd')) . '</td>';
					echo " </a></tr> ";
					$k++;
					
				}
				$i++;
			}
		?>
	</table> 
</div>

