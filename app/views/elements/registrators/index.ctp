<table id="registrators">
<?php 
	$registrators = $this->requestAction('registrators/index');

	echo $html->tableHeaders(array('Förnamn', 'Efternamn', 'E-post', 'Telefonnummer', 'C/O', 'Adress', 'Stad', 'Postkod', 'Extra information'));
	
	echo $html->tableCells($registrators, array('class' => 'odd'), array('class' => 'even'));
	
?>
</table>