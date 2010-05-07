<?php 
	$registration = $this->requestAction('people/index');
	$peopleHeaders = $this->requestAction('people/getListHeaders');
	$i=0;
?>

<!-- element/people/index.ctp -->

<div class="grid_12">
	<div class="grid_full">
		<h1>Lista på alla bokade</h1>
	</div>
	<table id="moduleIndex">
		<thead>
			<?php echo $html->tableHeaders($peopleHeaders); ?>
		</thead>
		<tbody>
			<?php foreach ($registration['Person'] as $row):?>
			<tr class="<?php echo $row['number']?>">
			<?php foreach ($row as $fieldValue): ?>
			<td>
			<?php 
				echo $html->link($fieldValue,'putRegistrationInSessionAndRedirect/'. $row['number']);
			?>
			</td>
			<?php endforeach;?>
			</tr>
			<?php
			$i++;
			endforeach;
			?>
		</tbody>
	</table> 
</div>

