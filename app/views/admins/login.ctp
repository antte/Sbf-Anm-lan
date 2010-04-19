<div class="grid_12">
	<div class="grid_full">
		<h2>Logga in till Admingränssnittet</h2>
	</div>
</div>


<div class="grid_12 login">

	<?php 
		if(!empty($errors)){?>
			
			<div id="login_error" class="login_info validationErrors grid_8">
				<div class="grid_full">
				<ul>
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
		echo $javascript->link('jq.form.conf/jq.validate.loginAdmin', $inline = false);
		echo $html->css('login', null, array(), false);
		
		echo $form->create(null, array('id' => 'login', 'class' => 'grid_8', 'action' => 'login'));
		echo $form->input('Admin.username', array('label' => 'Andvändarnamn'));
		echo $form->input('Admin.password', array('label' => 'Lösenord'));
	?>
	
	<div class="grid_8 login_info clearfix">
		<div class="grid_full">
			<p class="info">Skriv in i Användarnamn och lösenord </p>
		</div>
	</div>
	
	<?php
		echo $form->end('OK');
	?>
	<br class="clearfix" />
</div>