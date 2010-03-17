<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);
?>

<div id="registration" class="grid_8">


<div id="registration" class="">
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Registration'); ?> 
		
		<!--  Form helper - create input with label  -->
			<?php 
				echo $form->hidden('event_id', array('type' => 'text', 'default' => $event_id));
			?>
		<fieldset class="name grid_8 alpha" >
			<p class="obligatory">Fält markerade med * är obligatoriska uppgifter!</p>
			<?php
				echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_4 alpha'));
				echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_4 omega'));
			?>
		</fieldset>
		<fieldset class="role grid_8 alpha">
			<?php
				echo $form->input('role_id', array('options' => array($roles), 'label' => 'Anmäl dig som *', 'empty' => '(välj en)', 'div' => 'role alpha'));
			?>
			</fieldset>
		<fieldset class="email grid_8 alpha">
			<?php
				echo $form->input('email', array('type' => 'text', 'label' => 'E-post *', 'div' => 'email grid_4 alpha' ));
				echo $form->input('retype_email', array('type' => 'text', 'label' => 'Bekräfta e-post *', 'div' => 'retype_email grid_4 omega'));
			?>
		</fieldset>
		<fieldset class="contact grid_8 alpha">
			<?php
				echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon', 'div' => 'phone grid_4 alpha'));
				echo $form->input('c_o', array('type' => 'text', 'label' => 'C/O', 'div' => 'c_o grid_4 alpha'));
				echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress *', 'div' => 'address grid_4 alpha'));
				echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr *', 'div' => 'postcode alpha' ));
				echo $form->input('city', array('type' => 'text', 'label' => 'Stad *', 'div' => 'city omega')); 
			?>						
		</fieldset>
		<fieldset class="contact grid_8 alpha">
			<?php echo $form->submit('Skicka anmälan')?>
		
		</fieldset>
		
	<!--  Form helper - end form-->
	<?php echo $form->end(); ?>	
</div> 
