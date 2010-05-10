<!--  Reduction_code/create.ctp -->
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
<?php echo $this->element('reduction_codes/create_info');?>
<?php echo $this->element('javascript_info');?>

<div id="reduction_codes" class="grid_full">
	
	<?php 
		echo $form->create('Person', array('id' => 'addReductionCode', 'action' => 'addCodeToPersonInSession'));
		echo '<fieldset class="reduction_code grid_8 alpha">';
		echo $form->input('code', array('type' => 'text', 'label' => 'Fyll i din rabattkod', 'maxLength' => '8'));
		echo $form->input('person', array('options' => $people, 'label' => 'För person'));
		echo $form->submit('Lägg till', array('name' => 'create', 'style' => 'background: #96f97b;'));
		echo $form->submit('Ta bort', array('name' => 'remove', 'style' => 'background: #ff474c;'));
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

