<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);
	
	/*
	 * setting a bunch of variables for testing
	 * TODO remove this when deploying
	 */
	$eventName = "Ett jätte fint event";
	
	
?>

<div id="registration" class="grid_8">
	
	<h2><?php echo $eventName; ?></h2>
	
	<h3>Fyll i vilka som ska komma</h3>
	
	<?php 
		if (!empty($errors)) {
			echo '<ul id="validationErrors" class="message">';
				foreach ($errors as $error):?>
					<li>
						<?php echo $error; ?>
					</li>
				<?php endforeach;
			echo '</ul>';
		}
	?>
	
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Registration'); ?>
		
		<!--  Form helper - create input with label  -->
			<?php 
				echo $form->hidden('event_id', array('default' => $event_id));
			?>
		<fieldset class="name grid_8 alpha" >
			<p class="required">Fält markerade med * är obligatoriska uppgifter!</p>
			<?php
				echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_3'));
				echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_3'));
			?>
		</fieldset>
		<fieldset class="role grid_8 alpha">
			<?php
				echo $form->input('role_id', array('options' => array($roles), 'label' => 'Anmäl dig som *', 'empty' => '(välj en)', 'div' => 'role grid_5'));
			?>
		</fieldset>
		<fieldset class="contact grid_8 alpha">
			<?php echo $form->submit('Skicka anmälan')?>
		
		</fieldset>
		
	<!--  Form helper - end form-->
	<?php echo $form->end(); ?>	
</div> 
