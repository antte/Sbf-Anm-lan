<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokningar</h1>
	</div>
	<table id="moduleIndex">
	<?php 
	
		$registrators = $this->requestAction('registrators/index');
		$tableHeaders = $this->requestAction('registrators/getTableHeaders');
		
		echo "<thead>";
		echo $html->tableHeaders($tableHeaders);
		echo "</thead>";
		foreach ($registrators as $registrator): ?> 
			<tr class="<?php echo $registrator['Registration']['number']?>">
			<?php foreach ($registrator as $modelName => $fields): ?>
				<?php foreach($fields as $fieldName => $fieldValue): ?>
					<td>
						<?php echo $html->link($fields[$fieldName],'putRegistrationInSessionAndRedirect/'. $registrator['Registration']['number']);
							  echo $html->link('Skicka nytt mail', array('controller' => 'Admins', 'action' => 'sendRegistrationConfirmMail'));?>
					</td>
				<?php endforeach; ?>
			<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
		
	</table>
</div>