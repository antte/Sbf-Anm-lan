<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('editHover', $inline = false);
?>
<div class="grid_12">
	<div class="grid_full">
		<h2>Granska dina uppgifter </h2>
	</div>
</div>
<div class="grid_4" id="receipt_info">
	<div class="grid_full">
		<h2>Granskning</h2>
		<p>Var vänlig och kontrollera alla dina uppgifter innan du bekräftar din anmälan. För att ändra i någon uppgift, använd Redigera-länkarna under respektive del.</p>
		<p>Du kommer även att ha möjlighet att ändra i din order efter bekräftelse.</p>
	</div>

</div>
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