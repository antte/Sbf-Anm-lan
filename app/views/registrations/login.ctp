<div class="grid_12">
	<div class="grid_full">
		<h2>Logga in för att ändra i din bokning</h2>
	</div>
</div>


<div class="grid_12 login">

	<?php 
		
		if(isset($error)){
			?>
			<div id="login_error" class="login_info">
				<?php
				
				if($error == 'novalue'){
					echo "<p>Du har glömt att fylla i.";
				}
				elseif($error == 'wrongvalue'){
					echo "<p>Du har fyllt i fel data, var god kontrollera dina uppgifter.</p>";	
				}
				
				?>
				
			</div>
			<?php
		}
	
	
		echo $html->css('login', null, array(), false);
		echo $form->create(null, array('id' => 'login', 'class' => 'grid_8', 'controller' => 'registrations' , 'action' => 'login'));
		echo $form->input('Registration.number', array('label' => 'Bokningsnummer'));
		echo $form->input('Registrator.email', array('label' => 'E-post'));
	?>
	
	<div class="grid_8 login_info clearfix">
		<div class="grid_full">
			<p class="info">Du har fått bokningsnumret mailat till dig i samband med din bokning, kontrollera din mail. Om du har genomfört en bokning men tappat bort ditt nummer, kontakta Bilsportförbundets support.</p>
		</div>
	</div>
	
	<?php
		echo $form->end('Börja redigera');
	?>
	<br class="clearfix" />
</div>