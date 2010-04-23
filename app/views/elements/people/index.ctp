<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
<table id="registrations">
		<?php 
		$people = $this->requestAction('people/index');
		echo $html->tableHeaders(array ('Bokningsnummer', 'Förnamn', 'Efternamn', 'Roll'));
		?>
		<?php
		$k=0;
		foreach ($people as $company){ ?>
		<?php 
		foreach ($company as $person){ ?> 
		<tr class ="<?php echo ($k%2)? 'even': 'odd';?>" >
		<?php 	echo 	'<td>'. $person['number']. '</td>';
				echo	'<td>'.	$person['first_name']. '</td>';
				echo	'<td>'.	$person['last_name'] . '</td>';
				echo	'<td>'.	$person['role'] . '</td>';
			echo "</tr>";
			$k++;
			
			}
		}
		?>
</table> 
</div>

