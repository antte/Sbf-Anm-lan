<?php $people = $this->requestAction('people/receipt');
//debug($people);
?> 
		
	Anmälda personer	
	<?php foreach($people as $person):?>			
		<?php 
			echo $person['first_name'] . " ";
			echo $person['last_name'] . ", ";
			echo $person['role_name'] . "\n"; ?>
	<?php endforeach;?>
