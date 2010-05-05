<?php $fieldNames = $this->requestAction('reduction_codes/getFieldNamesForAdd');?>
<?php debug($fieldNames);?>
<div id="code_fields">
<?php echo $form->create(array('id' => 'reduction_codes'));?>
	<?php foreach($fieldNames as $fieldLabel => $fieldName): ?>
		<?php echo $form->input($fieldName, array('type' => 'text', 'label' => $fieldLabel,  'maxLength' => '127'));?>
	
	<?php endforeach; ?>
<?php echo $form->end('Lägg till'); ?>
</div> 