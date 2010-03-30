<?php //echo $this->renderElement('event_receipt')?>
<?php echo $this->renderElement('registration_receipt')?>
<?php 
	echo $form->create('');
	echo $form->submit();
	echo $form->end();
	?>

<?php echo $this->renderElement('person_receipt')?>
<?php echo $this->renderElement('registrator_receipt')?>