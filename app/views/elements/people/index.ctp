<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
	<table id="registrations">
		<?php 
		$people = $this->requestAction('people/index');
		echo $html->tableHeaders(array ('Bokningsnummer', 'Förnamn', 'Efternamn', 'Roll'));
		echo	'<tr><td>'.	$person['Förnamn']. '</td></td>';
		foreach ($people as $i => $person){ ?>
			<tr class ="<?php echo ($i%2)? 'even': 'odd';?>" >
			<?php
			echo	'<td>'.	$person['Förnamn']. '</td>';
			echo	'<td>'.	$person['Efternamn'] . '</td>';
			echo	'<td>'.	$person['Roll'] . '</td>';
		}
		?>
</table> 
</div>

