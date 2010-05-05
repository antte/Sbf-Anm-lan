<?php $fieldNames = $this->requestAction('reduction_codes/getFieldNamesForAdd');?>

<?php echo $form->create();?>
	<?php foreach($fielNames as $fieldName => $fieldLabel): ?>
		<?php echo $form->input($fieldName, array('type' => 'text', 'label' => 'fieldName', 'class' => 'grid_8', 'maxLength' => '127'));?>
	
	<?php endforeach; ?>
<?php echo $form->end('Lägg till'); ?>
