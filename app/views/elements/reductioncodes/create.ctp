<?php $fieldNames = $this->requestAction('reduction_codes/getFieldNamesForAdd');?>
<?php 
	$fieldNames = array(
		'code',
		'number_of_people'
	);
?>



<div class="grid_12">
	<div class="grid_full">
		<h2>Fyll i din rabattkod</h2>
	</div>
</div>
<ul>
	<?php foreach($fields as $field): ?>
	<li class="	<?php echo $form->input($fields,'code', array('type' => 'text', 'label' => 'Rabattkod', 'div' => 'code grid_3', 'maxLength' => '127'));?>">
	</li>
	<li class="	<?php echo $form->input($fields,'number_of_people', array('type' => 'text', 'label' => 'Antal Personer', 'div' => 'number_of_people grid_3', 'maxLength' => '127'));?>">
	</li>
</ul>
	<?php endforeach; ?>
	<?php echo $form->end('Spara'); ?>
	
