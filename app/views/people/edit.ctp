<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.persons', $inline = false);
	echo $javascript->link('addPersonField', $inline = false);
	
?>

<h2>Fyll i vilka som ska komma till <?php echo $event['name']; ?></h2>

<div id="choosepeopleamount" class="grid_8">
	
	<?php 
		if (!empty($errors)) {?>
			<ul id="validationErrors" class="message">
					<li>
						Du måste fylla i <strong>förnamn</strong>, <strong>efternamn</strong> och <strong>roll</strong> för alla personer.
					</li>
			</ul>
		<?php } ?>
		<?php 
			echo $form->create('Person', array('id' => 'addamount'));
			echo '<fieldset class="amount grid_8 alpha">';
			echo $form->input('amount', array('type' => 'text', 'label' => 'Hur många är i ditt sällskap?', 'value' => $amountOfPeople, 'div' => 'amount'));
			echo $form->submit('Ändra antal personer');
			echo "</fieldset>";
			echo $form->end();
			?>
	
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Person', array('action' => 'edit')); ?>
		
		<!--  Form helper - create input with label  -->
		<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
		
		
		
		<ol>
			<?php for( $i = 0; $i < $amountOfPeople; $i++ ): ?>
				<li>
					<fieldset class="name grid_8 alpha" >
						<?php 
							echo $form->input("Person.$i.first_name", array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_2', 'class' => 'required'));
							echo $form->input("Person.$i.last_name", array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_2', 'class' => 'required'));
							echo $form->input("Person.$i.role_id", array('options' => array($roles), 'label' => 'Anmäl dig som *', 'empty' => '(välj en)', 'div' => 'role grid_3', 'class' => 'required role'));
						?>
					</fieldset>
				</li>
			<?php endfor; ?>
		</ol>
			
		
		
		
		<fieldset class="submit grid_8 alpha">
			<?php echo $form->submit('Uppdatera')?>
		
		</fieldset>
		
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