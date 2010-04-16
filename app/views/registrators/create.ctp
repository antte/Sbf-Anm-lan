<!-- Help class that	 includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
	echo $javascript->link('jq.form.conf/jq.validate.registration', $inline = false);


?> 

<div class="grid_12">
	<div class="grid_full">
		<h2><?php echo "Kontaktuppgifter för anmälan till $eventName"; ?></h2>
	</div>
</div>

<div id="registration" class="grid_8">
	
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
	<?php echo $form->create( array ('id' => 'RegistratorAddForm', 'action' => 'add/'. $this->params['action'])); ?> 
		
		<?php if(isset($registrator)) { ?>
			<!--  Form helper - create input with label  -->
			<fieldset class="name grid_8 alpha" >
				<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
				<?php
					echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_3', 'maxLength' => '127', 'default' => $registrator['first_name']));
					echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_3', 'maxLength' => '127', 'default' => $registrator['last_name']));
				?>
			</fieldset>
			<fieldset class="email grid_8 alpha">
				<?php
					echo $form->input('email', array('type' => 'text', 'label' => 'E-post *', 'div' => 'email grid_3', 'maxLength' => '127', 'default' => $registrator['email'] ));
					echo $form->input('retype_email', array('type' => 'text', 'label' => 'Bekräfta e-post *', 'div' => 'retype_email grid_3', 'maxLength' => '127', 'default' => $registrator['retype_email']));
				?>
			</fieldset>
			<fieldset class="contact grid_8 alpha">
				<?php
					echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon *', 'div' => 'phone grid_3', 'maxLength' => '128', 'default' => $registrator['phone']));
					echo $form->input('c_o', array('type' => 'text', 'label' => 'C/O', 'div' => 'c_o grid_3', 'maxLength' => '127', 'default' => $registrator['c_o']));
					echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress *', 'div' => 'address grid_3', 'maxLength' => '127', 'default' => $registrator['street_address']));
					echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr *', 'div' => 'postcode grid_2', 'maxLength' => '127', 'default' => $registrator['postal_code'] ));
					echo $form->input('city', array('type' => 'text', 'label' => 'Stad *', 'div' => 'city grid_3', 'maxLength' => '127', 'default' => $registrator['city'])); 
				?>						
			</fieldset>
			<fieldset class="extra_information grid_8 alpha">
				<?php 
					echo $form->input('extra_information', array('type' => 'textarea', 'label' => 'Extra Information', 'div' => 'extra_information grid_3', 'default' => $registrator['extra_information']));
				
				?>
			</fieldset>
			
			<?php $submitName = "Ändra";
				} else { //not in review mode ?>
				
						<!--  Form helper - create input with label  -->
			<fieldset class="name grid_8 alpha" >
				<p class="requiredinfo">Fält markerade med * är obligatoriska uppgifter!</p>
				<?php
					echo $form->input('first_name', array('type' => 'text', 'label' => 'Förnamn *', 'div' => 'first_name grid_3', 'maxLength' => '127', 'default' => $first_name));
					echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn *', 'div' => 'last_name grid_3', 'maxLength' => '127', 'default' => $last_name));
				?>
			</fieldset>
			<fieldset class="email grid_8 alpha">
				<?php
					echo $form->input('email', array('type' => 'text', 'label' => 'E-post *', 'div' => 'email grid_3', 'maxLength' => '127'));
					echo $form->input('retype_email', array('type' => 'text', 'label' => 'Bekräfta e-post *', 'div' => 'retype_email grid_3', 'maxLength' => '127'));
				?>
			</fieldset>
			<fieldset class="contact grid_8 alpha">
				<?php
					echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon *', 'div' => 'phone grid_3', 'maxLength' => '127'));
					echo $form->input('c_o', array('type' => 'text', 'label' => 'C/O', 'div' => 'c_o grid_3', 'maxLength' => '127'));
					echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress *', 'div' => 'address grid_3', 'maxLength' => '127'));
					echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr *', 'div' => 'postcode grid_2', 'maxLength' => '127'));
					echo $form->input('city', array('type' => 'text', 'label' => 'Stad *', 'div' => 'city grid_3', 'maxLength' => '127')); 
				?>						
			</fieldset>
			<fieldset class="extra_information grid_8 alpha">
				<?php 
					echo $form->input('extra_information', array('type' => 'textarea', 'label' => 'Extra Information', 'div' => 'extra_information grid_3'));
				
				?>
			</fieldset>
				
				<?php 
					$submitName = "Nästa";
				}
				?>
				
				
			<fieldset class="contact grid_8 alpha">
				<?php 
					echo $form->submit($submitName, array('id' => 'registratorSubmit'));
				?>
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