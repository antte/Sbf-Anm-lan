<?php $people = $this->requestAction('people/receipt');
//debug($people);
?> 
		
	Anmälda personer	
	<?php foreach($people as $person):?>			
	Förnamn:<?php echo $person['first_name'];?>
	Efternamn:<?php echo $person['last_name'];?>
	Roll:<?php echo $person['role_name'];?>
	<?php endforeach;?>
