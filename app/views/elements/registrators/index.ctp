<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokningar</h1>
	</div>
	<table id="registrators">
	<?php 
		$registrators = $this->requestAction('registrators/index');
		
		echo "<thead>";
		echo $html->tableHeaders(
			array('Bokningsnr', 'Skapad', 'Ändrad', 'Förnamn', 'Efternamn', 'E-post', 'Telefonnummer')
		);
		echo "</thead>";
			foreach ($registrators as $i => $registrator){ ?> 
				<tr class ="<?php 	echo ($i%2)? 'even': 'odd';
							?>" >
				<?php 	
					foreach ($registrator as $j => $colum){
						echo 	'<td>'. $html->link($registrator[$j],'putRegistrationInSessionAndRedirect/'. $registrator['number'],array('class'=> ($i%2)? 'even': 'odd')) . '</td>';
					}
					echo " </a></tr> ";
					
				}
			?>
	</table>
</div>