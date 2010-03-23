<h2>SBF events</h2>
<ul>
<?php 
	foreach( $events as $event ){
		
		echo "<li>";
		echo $html->link( $event['Event']['name'], array('action' => 'view', $event['Event']['name']) );
		echo "</li>";
		
	}
?>
</ul>