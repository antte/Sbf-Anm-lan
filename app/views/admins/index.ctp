<?php echo $this->renderElement('adminPanel')?>
<div>
	<h1>Admin</h1>
	<table>
	<?php 
		echo $html->tableHeaders(array('Event namn','Bekräftningsmedelande','Aktiv'));	
		foreach ($events as $event){
			echo '<tr>';
			echo	'<td>'.	$html->link( $event['name'], array('action' => 'index', $event['id']))  . '</td>';
			echo	'<td>'.	$event['confirmation_message'] . '</td>';
			echo	'<td>'.	$event['is_active'] . '</td>';
		}
	?>	
	</table>
</div>
<?php debug($events); ?>

