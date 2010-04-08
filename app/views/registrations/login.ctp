<h2></h2>
<div class="grid_12">
	<?php 
		echo $html->css('login', null, array(), false);
		echo $form->create('login', array('id' => 'login'));
		echo $form->input('Registration.number');
		echo $form->input('Registrator.email');
		echo $form->end('Börja redigera');
	?>
</div>