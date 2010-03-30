<!-- Help class that	 includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);
	/**
	 * TODO
	 * edit mode:
	 * fält ska vara färdigifyllda (vyn behöver en in_review_mode + den behöver tillgång till registrator ifrån registration i session)
	 * och när man trycker submit ska man komma tillbaka till review sidan och inte till "nästa" steg
	 */

	$in_review_mode = true;
	$registrator = array(
				 		'first_name'=>  'kalle',
			 	 		'last_name'=>	 'olsson',
				 		'email'	=> 	 'peace@nu.nu',
				 		'retype_email' => 'peace@nu.nu',
				 		'phone'	=> '07463722',
				 		'c_o'	=>	'',
				 		'street_address' => 'anderssonsgata',
				 		'postal_code' => '12345',
				 		'city' =>	'Stockholm'
			 		);
?>

<?php $html->link('Töm Model session array', array('action' => 'clearSession', 'Registration'));?>

 

<h2><?php echo "Kontaktuppgifter för anmälan till $eventName"; ?></h2>

<div id="registration" class="grid_8">
	
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
		
		<?php if ($in_review_mode) { ?>		
			<!--  Form helper - create input with label  -->
			<fieldset class="name grid_8 alpha" >
				<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
				<?php
					echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_3', 'default' => $registrator['first_name']));
					echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_3', 'default' => $registrator['last_name']));
				?>
			</fieldset>
			<fieldset class="email grid_8 alpha">
				<?php
					echo $form->input('email', array('type' => 'text', 'label' => 'E-post *', 'div' => 'email grid_3', 'default' => $registrator['email'] ));
					echo $form->input('retype_email', array('type' => 'text', 'label' => 'Bekräfta e-post *', 'div' => 'retype_email grid_3', 'default' => $registrator['retype_email']));
				?>
			</fieldset>
			<fieldset class="contact grid_8 alpha">
				<?php
					echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon', 'div' => 'phone grid_3', 'default' => $registrator['phone']));
					echo $form->input('c_o', array('type' => 'text', 'label' => 'C/O', 'div' => 'c_o grid_3', 'default' => $registrator[0]['c_o']));
					echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress *', 'div' => 'address grid_3', 'default' => $registrator['street_address']));
					echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr *', 'div' => 'postcode grid_2', 'default' => $registrator['postal_code'] ));
					echo $form->input('city', array('type' => 'text', 'label' => 'Stad *', 'div' => 'city grid_3', 'default' => $registrator['city'])); 
				?>						
			</fieldset>
			<fieldset class="contact grid_8 alpha">
				<?php echo $form->submit('Ändra', array('id' => 'registratorSubmit'))?>
			</fieldset>		
		<?php } else { ?>
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
				<?php echo $form->submit('Skicka anmälan', array('id' => 'registratorSubmit'))?>
			</fieldset>		
		<?php } ?>
	<!--  Form helper - end form-->
	<?php echo $form->end(); ?>	
</div> 


<div id="javascript_info" class="grid_4" >
	<noscript>
		<div class="grid_full">
			<h2>Information</h2>
			<p>
				<em>För bästa funktionalitet rekommenderas att ni sätter på JavaScript - annars kan information gå förlorad vid felaktigt införda värden i formulären.</em> 
			</p>
		</div>
	</noscript>
</div>