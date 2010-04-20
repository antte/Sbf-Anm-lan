<div class="grid_12">
	<div class="grid_full">
		<h1>Admin</h1>
	</div>
	<div class="eventslist">
		<table>
		<?php
		echo $html->tableHeaders(array('Event namn','Bekräftningsmedelande','Aktiv'));
		foreach ($events as $i => $event){ ?>
			<tr class ="<?php echo ($i%2)? 'even': 'odd';?>" >
			<?php
			echo	'<td>'.	$html->link( $event['name'], array('action' => 'index', $event['id']))  . '</td>';
			echo	'<td>'.	$event['confirmation_message'] . '</td>';
			echo	'<td>'.	$event['is_active'] . '</td>';
		}
		?>
		</table>
	</div>
</div>
