<?php $fieldNames = $this->requestAction('reduction_codes/getFieldNamesForAdd');?>
<form>
	<?php foreach($fielName as $field): ?>
		<?php echo $form->input($fieldName,'code', array('type' => 'text', 'label' => 'Rabattkod', 'div' => 'code grid_3', 'maxLength' => '127'));?>">
	
	<?php endforeach; ?>
	<?php echo $form->end('Lägg till'); ?>
</form>