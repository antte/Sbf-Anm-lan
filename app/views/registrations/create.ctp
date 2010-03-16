<!-- Help class that includes this js file even thou we are not in head tag -->
<?php echo $javascript->link('jquery.1.4.2-min', $inline = false) ?>


<div>
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Registration',array('action' => 'create/'.$event_id)); ?> 
		<fieldset>
			<!--  Form helper - create input with label  -->
			<?php echo $form->hidden($event_id)?>
			<?php echo $form->input('first_name', array('type' => 'text', 'label' => 'Fšrnamn', 'id' => 'first_name')); ?>
			<?php echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn', 'id' => 'last_name')); ?>
			<?php echo $form->input('role', array('options' => array($roles), 'label' => 'AnmŠl dig som', 'id' => 'role', 'empty' => '(vŠlj en)')); ?>
			<?php echo $form->input('email', array('type' => 'text', 'label' => 'E-post', 'id' => 'email')); ?>
			<?php echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon', 'id' => 'phone')); ?>
			<?php echo $form->input('c_o', array('type' => 'text', 'label' => 'c/o', 'id' => 'c_o')); ?>
			<?php echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress', 'id' => 'street_address')); ?>
			<?php echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr', 'id' => 'postal_code')); ?>
			<?php echo $form->input('city', array('type' => 'text', 'label' => 'Stad', 'id' => 'city')); ?>
								
		</fieldset>
	<!--  Form helper - end form-->
	<?php echo $form->end('skicka'); ?>	
</div> 
