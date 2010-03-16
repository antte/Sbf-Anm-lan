<!-- Help class that includes this js file even thou we are not in head tag -->
<?php echo $javascript->link('jquery.1.4.2-min', $inline = false) ?>
<?php echo $javascript->link('jquery.validate', $inline = false) ?>
<?php echo $javascript->link('jq.validate.registration', $inline = false) ?>



<div>
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Registration'); ?> 
		<fieldset>
			<!--  Form helper - create input with label  -->
			<?php echo $form->hidden($event_id)?>
			<?php echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn', 'id' => 'first_name' , 'class' => 'required')); ?>
			<?php echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn', 'id' => 'last_name', 'class' => 'required')); ?>
			<?php echo $form->input('role', array('options' => array($roles), 'label' => 'Anmäl dig som', 'id' => 'role', 'empty' => '(välj en)', 'class' => 'required')); ?>
			<?php echo $form->input('email', array('type' => 'text', 'label' => 'E-post', 'id' => 'email', 'class' => 'required email')); ?>
			<?php echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon', 'id' => 'phone', 'class' => 'required digits')); ?>
			<?php echo $form->input('c_o', array('type' => 'text', 'label' => 'c/o', 'id' => 'c_o', 'class' => 'required')); ?>
			<?php echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress', 'id' => 'street_address', 'class' => 'required')); ?>
			<?php echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr', 'id' => 'postal_code', 'class' => 'required digits')); ?>
			<?php echo $form->input('city', array('type' => 'text', 'label' => 'Stad', 'id' => 'city', 'class' => 'required')); ?>
								
		</fieldset>
	<!--  Form helper - end form-->
	<?php echo $form->end('skicka'); ?>	
</div> 
