<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);
?>



<div>
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Registration'); ?> 
		<fieldset>
			<!--  Form helper - create input with label  -->
			<?php 
				echo $form->hidden($event_id);
				echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn'));
				echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn'));
				echo $form->input('role', array('options' => array($roles), 'label' => 'Anmäl dig som', 'empty' => '(välj en)'));
				echo $form->input('email', array('type' => 'text', 'label' => 'E-post'));
				echo $form->input('retype_email', array('type' => 'text', 'label' => 'Bekräfta E-post'));
				echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon'));
				echo $form->input('c_o', array('type' => 'text', 'label' => 'c/o'));
				echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress'));
				echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr'));
				echo $form->input('city', array('type' => 'text', 'label' => 'Stad')); 
			?>
								
		</fieldset>
	<!--  Form helper - end form-->
	<?php echo $form->end('Skicka anmälan'); ?>	
</div> 
