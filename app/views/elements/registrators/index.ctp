<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokningar</h1>
	</div>
	<?php echo $html->link('en bokning', array('controller' => 'admins', 'action' => 'putRegistrationInSessionAndRedirect', 'O2H1RD' ))?>
	<table id="moduleIndex">
	<?php 
		$registrators = $this->requestAction('registrators/index');
		
		echo "<thead>";
		echo $html->tableHeaders(
			array('Bokningsnr', 'Skapad', 'Ändrad', 'Förnamn', 'Efternamn', 'E-post', 'Telefonnummer', 'C/O', 'Adress', 'Stad', 'Postkod', 'Extra information')
		);
		echo "</thead>";
			foreach ($registrators as $i => $registrator){ ?> 
				<tr >
				<?php 	
					foreach ($registrator as $j => $colum){
						echo 	'<td>'. $html->link($registrator[$j],'putRegistrationInSessionAndRedirect/'. $registrator['number']) . '</td>';
					}
					echo " </a></tr> ";
					
				}
			?>
	</table>
</div>