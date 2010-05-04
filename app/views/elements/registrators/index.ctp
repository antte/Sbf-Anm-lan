<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokningar</h1>
	</div>
	<table id="moduleIndex">
	<?php 
	
		$registrators = $this->requestAction('registrators/index');
		$tableHeaders = $this->requestAction('registrators/getTableHeaders');
		$tableHeaders[]= 'Mail';
		$tableHeaders[]= 'Ta bort';
		echo "<thead>";
		echo $html->tableHeaders($tableHeaders);
		echo "</thead>";
		foreach ($registrators as $registrator): ?> 
			<tr class="<?php echo $registrator['Registration']['number']?>">
			<?php foreach ($registrator as $modelName => $fields): ?>
				<?php foreach($fields as $fieldName => $fieldValue): ?>
					<td>
						<?php echo $html->link($fields[$fieldName],'putRegistrationInSessionAndRedirect/'. $registrator['Registration']['number']);
							  ?>
					</td>
				<?php endforeach; ?>
			<?php endforeach; ?>
					<td>
						<?php echo $html->image('email-arrow.png', array(
							'alt' => 'Skicka bekräftelsen igen',
							'url' => array('controller' => 'admins', 'action' => 'resendConfirmMail',$registrator['Registration']['number'] ), array('class' => 'button')
						)); ?>
					</td>
					<td>
						<?php echo $html->image('remove.png', array(
							'alt' => 'Ta bort registreringen',
							'url' => array('controller' => 'registrations', 'action' => 'deleteRegistrationAndRedirect',$registrator['Registration']['number'] ), array('class' => 'button delete')
						)); ?>	
					</td>
			</tr>
		<?php endforeach; ?>
		
	</table>
</div>