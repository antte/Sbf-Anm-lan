<?php $registrator = $this->requestAction('Registrators/receipt');
//debug($registrator);
?> 

<?php echo $registrator['first_name'] . ' '; ?>
		<?php echo $registrator['last_name']?>
		<?php echo $registrator['c_o']?>
		<?php echo $registrator['street_address']?>
		<?php echo $registrator['postal_code']?>
		<?php echo $registrator['city']?>
		Kontakt:
		<?php echo $registrator['email']?>
		<?php echo $registrator['phone']?>
		