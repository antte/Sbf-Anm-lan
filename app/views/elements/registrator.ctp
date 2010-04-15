<?php $registration = $this->requestAction('registrations');?> 
<div id="registrator" class="grid_8">
	<div class="grid_full">
		<h3>Bokningsinformation</h3>
		
		<div class="grid_4 alpha">
			<h4>Bokare</h4>
			<p class="first_name"><?php echo $registration['Registrator']['first_name'] . ' '; ?>
			<?php echo $registration['Registrator']['last_name']?></p>
		</div>
		
		<div class="grid_3 omega">
			<h4>Adress</h4>
			<p><?php echo $registration['Registrator']['c_o']?></p>
			<p><?php echo $registration['Registrator']['street_address']?></p>
			<p><?php echo $registration['Registrator']['postal_code'] . " " . $registration['Registrator']['city']?></p>
		</div>
		
		<div class="grid_7 alpha">
			<h4>Kontakt</h4>
			<p class="email"><?php echo $registration['Registrator']['email']?></p>
			<p class="phone"><?php echo $registration['Registrator']['phone']?></p>
		</div>

		<div class="grid_8 alpha">
			<h4>Extra Information</h4>
			<p class="extra_information"><?php echo $registration['Registrator']['extra_information'] . "\r\n"?></p>
		</div>
		
		
	</div>
</div>