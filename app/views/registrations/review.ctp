<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('editHover', $inline = false);
?>
<div class="grid_12">
	<div class="grid_full">
		<h2>Granska dina uppgifter </h2>
	</div>
</div>
<?php echo $this->renderElement('registrations/review_info'); ?>
<?php echo $this->renderElement('registration')?>
<?php echo $this->renderElement('person');?>
<div class="edit_link grid_8">
	<?php echo $html->link( 'Redigera',array('controller'=>'People', 'action'=>'create'));?>
</div>
<?php echo $this->renderElement('registrator');?>
<div class="edit_link grid_8">
	<?php echo $html->link( 'Redigera',array('controller'=>'Registrators', 'action'=>'create'));?>
</div>
<div class="grid_8">
	<?php 
		echo $form->create('Registration' , array('action' => 'add/review'));
		echo "<fieldset>";
		
		if($this->requestAction('admins/checkAdminLoggedIn')) {
			echo $form->input('sendConfirmationEmail', array('type' => 'checkbox', 'checked' => true, 'label' => 'Vill du att ett bekräftelsemail ska skickas till Kontaktpersonen för bokningen?'));
		}
		
		echo $form->submit('Spara');
		echo "</fieldset>";
		echo $form->end();
	?>
</div>