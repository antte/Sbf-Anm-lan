<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
	<table id="registrations">
		<?php 
		$people = $this->requestAction('people/index');
		echo $html->tableHeaders(array ('Förnamn', 'Efternamn', 'Roll'));
		foreach($people as $person) {
		
			echo $html->tableCells($person, array('class' => 'odd'), array('class' => 'even'));	
		}
		?>
	</table>
</div>