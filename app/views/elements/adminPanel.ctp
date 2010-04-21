<div id="adminPanel" class="grid_12">
	<div class="grid_full">
		<?php echo $html->link( 'Byt evenemang', array('controller' => 'admins', 'action' => 'events')); ?>
		<?php echo $html->link( 'Logga ut', array('controller' => 'admins', 'action' => 'logout'), array( 'class' => 'logout') );?>
		<?php if ($event = $this->requestAction('events/index')): ?>
			<h2><?php echo $html->link($event['name'],array ('controller' => 'admins', 'action' => 'event' , $event['id']))?></h2>
			<?php endif;?>
		<?php if ($steps = $this->requestAction('admins/steps')) :?>
			<ol id="adminSteps">
				<?php foreach($steps as $step): ?>
					<li class="<?php echo $step['classes']; ?>">
						<?php echo $html->link($step['label'], array('controller' => $step['controller'], 'action' => $step['action']));?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif;?>
	</div>
</div>
