<!-- Help class that includes this js file even thou we are not in head tag -->
<?php echo $javascript->link('jquery.1.4.2-min', $inline = false) ?>


<section>
	<!--  Form helper - sets action post - parse form to the registration model class-->
	<?php echo $form->create('Registration',array('action' => 'create/'.$event_id)); ?> 
		<fieldset>
			<!--  Form helper - create input first_name  -->
			<?php echo $form->hidden($event_id)?>
			<?php echo $form->input('first_name', array('type' => 'text', 'label' => 'Fšrnamn')); ?>
			<?php echo $form->input('last_name', array('type' => 'text', 'label' => 'Efternamn')); ?>
			
			<?php 
				//testdata to option 
				//$roles = array( '1' => 'Vinnare', '2' => 'Medfoljande' , '3' => 'Bamse');
				echo $form->input('role', array('options' => array($roles), 'label' => 'AnmŠl dig som')); ?>
			
			<?php echo $form->input('email', array('type' => 'text', 'label' => 'E-post')); ?>
			<?php echo $form->input('phone', array('type' => 'text', 'label' => 'Telefon')); ?>
			<?php echo $form->input('c_o', array('type' => 'text', 'label' => 'c/o')); ?>
			<?php echo $form->input('street_address', array('type' => 'text', 'label' => 'Adress')); ?>
			<?php echo $form->input('postal_code', array('type' => 'text', 'label' => 'Postnr')); ?>
			<?php echo $form->input('city', array('type' => 'text', 'label' => 'Stad')); ?>
			
			
		</fieldset>	
	
	<!--  Form helper - end form-->
	<?php echo $form->end('Submit'); ?>	
</section> 
