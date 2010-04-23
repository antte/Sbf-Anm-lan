<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokningar</h1>
	</div>
	<?php echo $html->link('en bokning', array('controller' => 'admins', 'action' => 'putRegistrationInSessionAndRedirect', 'O2H1RD' ))?>
	<table id="registrators">
	<?php 
		$registrators = $this->requestAction('registrators/index');
	
		echo $html->tableHeaders(array('Bokningsnummer', 'Skapad', 'Ändrad', 'Förnamn', 'Efternamn', 'E-post', 'Telefonnummer', 'C/O', 'Adress', 'Stad', 'Postkod', 'Extra information'));
		
		echo $html->tableCells($registrators, array('class' => 'odd'), array('class' => 'even'));
		
	?>
	</table>
</div>