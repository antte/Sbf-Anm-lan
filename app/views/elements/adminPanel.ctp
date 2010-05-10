<?php 
//get session stored event info	
$event = $this->requestAction('events/index/'); 
$exportOptions = $this->requestAction('admins/getExcelExportOptions');
$eventOptions = $this->requestAction('events/index');
?>

<div id="adminPanel" class="grid_12">
	<div class="grid_full">
		<ul id="adminUtilitiesMenu">
			<li><?php echo $html->link( 'Logga ut', array('controller' => 'admins', 'action' => 'logout'), array( 'class' => 'logout') );?></li>
			<li id="exportIcon">Byt evenemang<span> ▼</span>
				<ul id="changeEvent">
				<?php foreach($eventOptions as $eventName => $event): ?>
				<li>	 
				<?php echo $html->link($event, array('controller' => 'admins', 'action' => 'events', $eventName)); ?>
			</li>
				<?php endforeach;?>
			</ul>
			<li id="exportIcon">Exportera<span> ▼</span>
				<ul id="excelExport">
					<?php foreach($exportOptions as $exportModels => $exportOption): ?>
					<li>
						<?php echo $html->link($exportOption, array('controller' => 'admins', 'action' => 'excelExport', $exportModels)); ?>
					</li>
					<?php endforeach;?>
				</ul>
			</li>
		</ul>
		
		<?php if(isset($event['id'])): ?>
			<h2><?php echo $html->link($event['name'],array ('controller' => 'admins', 'action' => 'event' , $event['id']))?></h2>
		<?php endif; ?>
		<?php 
		// if no pass is sent to the panel, we handle it. Example if we come from login;
			if(isset($this->params['pass'][0])){
				$pass = $this->params['pass'][0];
			} else {
				$pass ='';
			}
		?>
		<?php if ($steps = $this->requestAction('admins/steps/'.$pass)) :?>
			<ol id="adminSteps">
				<?php foreach($steps as $step): ?>
					<li class="<?php echo $step['classes']; ?>">
						<?php echo $html->link($step['admin_label'], array('controller' => 'admins', 'action' => 'eventIndex', $step['controller']));?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif;?>
	</div>
</div>
