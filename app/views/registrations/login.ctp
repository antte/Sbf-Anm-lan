<h2></h2>
<div class="grid_12">
	<?php 
		echo $html->css('login', null, array(), false);
		echo $form->create('login', array('id' => 'login', 'class' => 'grid_8'));
		echo $form->input('Registration.number', array('label' => 'Bokningsnummer'));
		echo $form->input('Registrator.email', array('label' => 'E-post'));
		echo $form->end('Börja redigera');
	?>
</div>