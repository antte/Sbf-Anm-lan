<div class="grid_12">
	<div class="grid_full">
		<h1>Admin</h1>
	</div>
	<div class="eventslist">
		<table id="events">
			<thead>
		<?php
		echo $html->tableHeaders(array('Event namn','Bekräftningsmedelande','Aktiv'));
		echo "</thead>";
		foreach ($events as $i => $event){ ?>
			<tr class ="<?php echo ($i%2)? 'even': 'odd';?>" >
			<?php
			echo	'<td>'.	$html->link( $event['name'], array('action' => 'chooseEvent/'. $event['id'])) . '</td>';
			echo	'<td>'.	$event['confirmation_message'] . '</td>';
			echo	'<td>'.	$event['is_active'] . '</td>';
		}
		?>
		</table>
	</div>
</div>