<div class="grid_12">
	<div class="grid_full">
		<h2>Logga in för att ändra i din bokning</h2>
	</div>
</div>


<div class="grid_12 login">

	<?php 
		if(!empty($errors)){?>
			
			<div id="login_error" class="login_info validationErrors grid_8">
				<div class="grid_full">
				<?php foreach ($errors as $key => $error): ?>
					<li>
						<?php echo $error; ?>
					</li>
				<?php endforeach;?>			
			</ul>
			
				</div>
			</div>
			<?php
		}
	
		echo $javascript->link('jquery.1.4.2-min', $inline = false);
		echo $javascript->link('jquery.validate', $inline = false);
		echo $javascript->link('jq.form.conf/jq.validate.login', $inline = false);
		echo $html->css('login', null, array(), false);
		echo $form->create(null, array('id' => 'login', 'class' => 'grid_8', 'controller' => 'registrations' , 'action' => 'addlogin'));
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