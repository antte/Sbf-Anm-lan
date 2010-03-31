<?php 
	$registration = $this->requestAction('registrations');
	$roles = $this->requestAction('roles');
	$people  = $registration['Person'];
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
				</tr>
			</thead>
			<tbody>			
			<?php 
				$i=0;
				foreach($people as $person):	?>
				<tr class ="<?php if($i%2) echo 'even'; else echo 'odd';?>" >
					<td><?php echo $person['first_name'];?></td>
					<td><?php echo $person['last_name'];?></td>
					<td><?php 
						foreach($roles as $role) {
							if($role['id'] == $person['role_id']) echo $role['name'];
						} ?>
					</td>
				</tr>
			<?php 
				$i++;	
				endforeach;?>
			</tbody>
		</table>
			
	</div>
</div>
