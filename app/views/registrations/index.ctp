<h1>SBF events</h1>
<ul>
<?php 
	foreach( $events as $event ){
		
		echo "<li>";
		echo $html->link( $event['Event']['name'], array( 'controller' => 'Registrations', 'action' => 'create', $event['Event']['id']));
		echo "</li>";
		
	}
	
?>
</ul>