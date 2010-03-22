<h2><?php echo $event['Event']['name']; ?></h2>
<?php 
	if ($event['Event']['is_active']) {
		echo "<p>";
		echo $html->link("Anmäl dig till {$event['Event']['name']}" , array('controller' => 'registrations', 'action' => 'create', $event['Event']['id']));
		echo "</p>";
	}
?>