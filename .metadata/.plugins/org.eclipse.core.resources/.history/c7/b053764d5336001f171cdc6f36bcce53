<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);
	echo $javascript->link('jquery.multiFieldExtender.min', $inline = false);
	echo $javascript->link('addPersonField', $inline = false);
	
	
?>

<?php 	
	/*
	 * setting a bunch of variables for testing
	 * TODO remove this when deploying
	 */
	$eventName = "Ett jätte fint event";
	$event_id = 2;
	$roles = array ('1' => 'blaaa', '2' => 'blelble');
	$amount = 3;
	
?>

<div id="choosepeopleamount" class="grid_8">
	
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
	
	<fieldset class="amount grid_8 alpha">
		<?php 
			echo $form->create('RegistrationPeopleAmount');
			$end = $form->end("Ändra antal personer", array('div' => 'amount_submit'));
			echo $form->input('amount', array('type' => 'text', 'label' => 'Hur många är i ditt sällskap?', 'div' => 'amount grid_7', 'after' => $end));
		?>
	</fieldset>
	
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('RegistrationPeople'); ?>
		
		<!--  Form helper - create input with label  -->
			<?php 
				echo $form->hidden('event_id', array('default' => $event_id));
			?>
		<p class="required">Fält markerade med * är obligatoriska uppgifter!</p>
		
		
		
		<ol>
			<?php for( $i = 0; $i < $amount; $i++ ): ?>
				<li>
					<fieldset class="name grid_8 alpha" >
						<?php 
							echo $form->input('first_name$i', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_2'));
							echo $form->input('last_name$i', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_2'));
							echo $form->input('role_id$i', array('options' => array($roles), 'label' => 'Anmäl dig som *', 'empty' => '(välj en)', 'div' => 'role grid_3'));
						?>
					</fieldset>
				</li>
			<?php endfor; ?>
		</ol>
			
		
		
		
		<fieldset class="submit grid_8 alpha">
			<?php echo $form->submit('Nästa')?>
		
		</fieldset>
		
	<!--  Form helper - end form-->
	<?php echo $form->end(); ?>	
</div> 
