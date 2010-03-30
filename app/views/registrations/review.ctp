<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('editHover', $inline = false);
?>
<div class="grid_4" id="receipt_info">
	<div class="grid_full">
		<h2>Granskning</h2>
		<p>Nu har du kommit till granskningssteget kolla noga igenom informationen och redigera vid behov</p>
	</div>

</div>
<?php //echo $this->renderElement('event_receipt')?>
<?php echo $this->renderElement('registration_receipt')?>
<?php echo $this->renderElement('person_receipt');?>
<div class="edit_link grid_8">
	<?php echo $html->link( 'Redigera',array('controller'=>'People', 'action'=>'create','in_review_mode:1'));?>
</div>
<?php echo $this->renderElement('registrator_receipt');?>
<div class="edit_link grid_8">
	<?php echo $html->link( 'Redigera',array('controller'=>'Registrators', 'action'=>'create','in_review_mode:1'));?>
</div>
<div class="grid_8">
	<?php 
		echo $form->create('Registration' , array('action' => 'finalize'));
		echo "<fieldset>";
		echo $form->submit('Bekräfta anmälan');
		echo "</fieldset>";
		echo $form->end();
	?>
</div>