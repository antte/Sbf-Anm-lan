<h2><?php echo $event['Event']['name']; ?></h2>
<?php 
	echo "<p>";
	//test if the event is still aktive for registration 
	if ($event['Event']['is_active']) {
		echo $html->link("Anmäl dig till {$event['Event']['name']}" , array('controller' => 'registrations', 'action' => 'index' ,$event['Event']['id'] ));
	} else {
		echo "Du kan inte anmäla dig till {$event['Event']['name']}.";
	}
	echo "</p>";
?>