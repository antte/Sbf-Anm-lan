<?php $registrator = $this->requestAction('Registrators/receipt');
//debug($registrator);
?> 

<?php echo $registrator['first_name'] . " "; 
		 echo $registrator['last_name'] . "\n";
		 echo $registrator['c_o'] . "\n";
		 echo $registrator['street_address'] . "\n";
		 echo $registrator['postal_code'] . " ";
		 echo $registrator['city'] . "\n\n";
		 echo "Kontakt: \n";
		 echo $registrator['email']. "\n";
		 echo $registrator['phone']?>
		