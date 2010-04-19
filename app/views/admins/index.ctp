<div class="grid_11">
	<div class="grid_full">
		<h1>Gör ditt val</h1>
		<table>
	<?php
		echo $html->tableHeaders(
    	array(
      	'id', 
      	'name',
      	'confirmation_message',
      	'is_active'
    	)
	);

	foreach($events as $event) {
  	echo $html->tableCells(
      array(
        array(
          $event['Event']['id'],
          $event['Event']['name'],
          $event['Event']['confirmation_message'],
          $event['Event']['is_active']
        )
      )
    );
	}
?>

		</table>		
	</div>
</div>


<?php echo $html->css('firstblood', null, array(), false);?>

