<?php $people = $this->requestAction('people/receipt');
//debug($people);
?> 
<div id="entrants" class="grid_8">
	<div class="grid_full">
	
		<h3>Anmälda personer</h3>
	
		<table id="receipt_entrants">
			<thead>
				<tr>
					<th>Förnamn</th>
					<th>Efternamn</th>
					<th>Roll</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($people as $person):	?>
				<tr>
					<td><?php echo $person['first_name'];?></td>
					<td><?php echo $person['last_name'];?></td>
					<td><?php echo $person['role_name'];?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
			
	</div>
</div>
