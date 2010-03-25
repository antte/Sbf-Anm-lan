<!-- Help class that	 includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);
?>
<?php $html->link('Töm Model session array', array('action' => 'clearSession', 'Registration'));?>
<div id="registration" class="grid_8">
	
	<h2><?php echo "Kontakuppgifter för registrering till $eventName"; ?></h2>
	<?php 
//	debug($sessionApa);
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
	<?php echo $form->create('Registrator'); ?> 
		
		<!--  Form helper - create input with label  -->
		<fieldset class="name grid_8 alpha" >
			<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
			<?php
				echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_3'));
				echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_3'));
			?>
		</fieldset>
		<fieldset class="email grid_8 alpha">
			<?php
				echo $form->input('email', array('type' => 'text', 'label' => 'E-post *', 'div' => 'email grid_3' ));
				echo $form->input('retype_email', array('type' => 'text', 'label' => 'Bekräfta e-post *', 'div' => 'retype_email grid_3'));
			?>
		</fieldset>
		<fieldset class="contact grid_8 alpha">
			<?php
				echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon', 'div' => 'phone grid_3'));
				echo $form->input('c_o', array('type' => 'text', 'label' => 'C/O', 'div' => 'c_o grid_3'));
				echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress *', 'div' => 'address grid_3'));
				echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr *', 'div' => 'postcode grid_2' ));
				echo $form->input('city', array('type' => 'text', 'label' => 'Stad *', 'div' => 'city grid_3')); 
			?>						
		</fieldset>
		<fieldset class="contact grid_8 alpha">
			<?php echo $form->submit('Skicka anmälan')?>
		
		</fieldset>
		
	<!--  Form helper - end form-->
	<?php echo $form->end(); ?>	
</div> 
<div id="info" class="grid_4" >
	<noscript>
		<h2> Info </h2>
		<div>
			<p>
				<em>För bästa funktionalitet rekomenderars att Ni sätter på Javascript Annanrs kan information gå förlorad vi omladdning av sidan</em> 
			</p>
		</div>
	</noscript>
</div>