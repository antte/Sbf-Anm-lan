<table id="registrations">
		<h1>Lista på alla bokade</h1>
		<?php 
		$this->requestAction('people/index');
		echo $html->tableHeaders(array ('Förnamn', 'Efternamn', 'Roll'));
		foreach($people as $person) {
		
			echo $html->tableCells($person, array('class' => 'odd'), array('class' => 'even'));	
		}
		?>
</table>
