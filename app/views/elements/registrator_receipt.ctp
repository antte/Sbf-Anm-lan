<?php $registrator = $this->requestAction('Registrators/receipt');
//debug($registrator);
?> 
<div id="registrator" class="grid_8">
	<div class="grid_full">
		<h3>Bokningsinformation</h3>
		
		<div class="grid_4 alpha">
			<h4>Bokare</h4>
			<p class="first_name"><?php echo $registrator['first_name'] . ' '; ?>
			<?php echo $registrator['last_name']?></p>
		</div>
		
		<div class="grid_3 omega">
			<h4>Adress</h4>
			<p><?php echo $registrator['c_o']?></p>
			<p><?php echo $registrator['street_address']?></p>
			<p><?php echo $registrator['postal_code'] . " " . $registrator['city']?></p>
		</div>
		
		<div class="grid_7 alpha">
			<h4>Kontakt</h4>
			<p class="email"><?php echo $registrator['email']?></p>
			<p class="phone"><?php echo $registrator['phone']?></p>
		</div>
		
	</div>
</div>