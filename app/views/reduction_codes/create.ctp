<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.codes', $inline = false);
	
	$people = $this->requestAction('people/getPeopleListFromSession');
?>
<div class="grid_12">
	<div class="grid_full">
		<h2>Prisuppgifter och rabattkoder för <?php echo $eventName;?></h2>
	</div>
</div>
<div id="people" class="grid_8">
	
	
	<?php 
		if (!empty($errors)) {?>
			<ul id="validationErrors" class="message">
				<?php foreach ($errors as $key => $error): ?>
					<li>
						<?php echo $error; ?>
					</li>
				<?php endforeach;?>			
			</ul>
		<?php } ?>
	
</div>
<?php echo $this->element('person');?>

<div id="reduction_codes" class="grid_full">
	
	<?php 
		echo $form->create('Person', array('id' => 'addReductionCode', 'action' => 'addCodeToPersonInSession'));
		echo '<fieldset class="reduction_code grid_8 alpha">';
		echo $form->input('code', array('type' => 'text', 'label' => 'Fyll i din rabattkod', 'maxLength' => '8'));
		echo $form->input('person', array('options' => $people, 'label' => 'För person'));
		echo $form->submit('OK');
		echo "</fieldset>";
		echo $form->end();
	?>
</div>
<div id="next" class="grid_8">
	
	<?php 
		echo $form->create('ReductionCode', array('action' => 'next'));
		echo '<fieldset class="next grid_8 alpha">';
		echo $form->submit('Nästa');
		echo "</fieldset>";
		echo $form->end();
	?>
</div>

<noscript>
	<div id="javascript_info" class="grid_4" >
		<div class="grid_full">
			<h2>Information</h2>
			<p>
				<em>För bästa funktionalitet rekommenderas att ni sätter på JavaScript - annars kan information gå förlorad vid felaktigt införda värden i formulären.</em> 
			</p>
		</div>
	</div>
</noscript>