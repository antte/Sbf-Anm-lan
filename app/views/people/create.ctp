<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.persons', $inline = false);
	echo $javascript->link('addPersonField', $inline = false);
	/**
	 * todo:
	 * edit mode:
	 * fält ska vara färdigifyllda (vyn behöver en in_review_mode + den behöver tillgång till people ifrån registration i session)
	 * och när man trycker submit ska man komma tillbaka till review sidan och inte till "nästa" steg
	 */
	/* TODO REMOVE all these ugly comments when we're done
	$in_review_mode = true;
	$people = array(
		0 => array(
			'first_name' => 'pelle'
			,'last_name' => 'phant'
			,'role_id' => 14
		)
		,3 => array(
			'first_name' => 'kalle'
			,'last_name' => 'nalle'
			,'role_id' => 15
		)
	);
	*/
?>

<h2>Fyll i vilka som ska komma till <?php echo $eventName;?></h2>

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
	<?php if( isset($in_review_mode) && $in_review_mode) {
		echo $form->create('Person', array('class' => 'edit', 'id' => 'PersonAddForm', 'url' => '/people/add/in_review_mode:1'));
	} else {
		echo $form->create('Person'); 
	}
	?>
		
		<!--  Form helper - create input with label  -->
		<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
		
		
		<?php if($in_review_mode) { ?>
		<ol>
			<?php foreach( $people as $key => $person ): ?>
				<li>
					<fieldset class="name grid_8 alpha" >
						<?php 
							echo $form->input("Person.$key.first_name", array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_2', 'class' => 'required', 'default' => $person['first_name']));
							echo $form->input("Person.$key.last_name", array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_2', 'class' => 'required', 'default' => $person['last_name']));
							echo $form->input("Person.$key.role_id", array('options' => array($roles), 'label' => 'Anmäl dig som *', 'empty' => '(välj en)', 'div' => 'role grid_3', 'class' => 'required role', 'default' => $person['role_id']));
						?>
					</fieldset>
				</li>
			<?php endforeach; ?>
			<?php //echo $form->input("in_review_mode", array('type' => 'hidden', 'default' => 1)); ?>
		</ol>
		<fieldset class="submit grid_8 alpha">
			<?php echo $form->submit('Ändra')?>
		
		</fieldset>
		<?php } else { //not in review mode ?>
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
			<?php echo $form->submit('Nästa')?>
		
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