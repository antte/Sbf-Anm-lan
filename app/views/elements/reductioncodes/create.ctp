<?php $fieldNames = $this->requestAction('reduction_codes/getFieldNamesForAdd');?>

<?php echo $form->create(array('id' => 'reduction_codes', 'class' => 'grid_8'));?>
	<?php foreach($fieldNames as $fieldName => $fieldLabel): ?>
		<?php echo $form->input($fieldName, array('type' => 'text', 'label' => '',  'maxLength' => '127'));?>
	
	<?php endforeach; ?>
<?php echo $form->end('Lägg till'); ?>