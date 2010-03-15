<h1>SBF events</h1>
<ul>
<?php 
	pr($events);
	foreach( $events as $event ){
		
		echo "<li>";
		//echo $event['Event']['name'] . " - id: " . $event['Event']['id'];
		echo $html->link( $event['Event']['name'], array( 'controller' => 'Registrations', 'action' => 'create', $event['Event']['id']));
		
		echo "</li>";
		
	}
	
?>
</ul>