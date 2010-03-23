<h2><?php echo $event['Event']['name']; ?></h2>
<?php 
	echo "<p>";
	if ($event['Event']['is_active']) {
		echo $html->link("Anmäl dig till {$event['Event']['name']}" , array('controller' => 'registrations', 'action' => 'create', $event['Event']['id']));
	} else {
		echo "Du kan inte anmäla dig till {$event['Event']['name']}.";
	}
	echo "</p>";
?>