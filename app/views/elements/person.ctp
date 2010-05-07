<?php 
	$registration = $this->requestAction('registrations');
	$roles = $this->requestAction('roles');
	$people  = $registration['Person'];
	$event = $this->requestAction('events');
	
	$numberFormat = array(
		'before' => '', 
		'decimals' => ',', 
		'thousands' => '.',
		'after' => ' kr'
	);
	$sum = $this->requestAction('invoices/getSum');
	?> 
<div id="entrants" class="grid_8">
	<div class="grid_full">
	
		<h3>Anmälda personer</h3>
	
		<table id="receipt_entrants">
			<thead>
				<tr>
					<th>Förnamn</th>
					<th>Efternamn</th>
					<th>Anmäld som</th>
					<th>Pris</th>
				</tr>
			</thead>
			<tbody>			
			<?php 
				$i=0;
				foreach($people as $person):	?>
				<tr class ="<?php if($i%2) echo 'even'; else echo 'odd';?>" >
					<td><?php echo $person['first_name'];?></td>
					<td><?php echo $person['last_name'];?></td>
					<td><?php foreach($roles as $id => $name) {
							if($id == $person['role_id']) echo $name;
						} ?>
					</td>
					<td><?php echo $event['price_per_person']." kr";?></td>
					<td><?php echo $person['reduction_code_id']?></td>
				</tr>
			<?php 
				$i++;	
				endforeach;?>
			</tbody>
		</table>
			<p class="sum">
				Summa: <?php echo $number->format( $sum, $numberFormat );?>
			</p>
	</div>
</div>
