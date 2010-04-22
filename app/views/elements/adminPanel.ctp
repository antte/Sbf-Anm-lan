<?php 
	$event = $this->requestAction('events/index/'); 
?>

<div id="adminPanel" class="grid_12">
	<div class="grid_full">
		<ul id="adminUtilitiesMenu">
			<li><?php echo $html->link( 'Logga ut', array('controller' => 'admins', 'action' => 'logout'), array( 'class' => 'logout') );?></li>
			<li><?php echo $html->link( 'Byt evenemang', array('controller' => 'admins', 'action' => 'events') , array('class' => 'changeEvent')); ?></li>
		</ul>
		<?php if(isset($event['id'])): ?>
			<h2><?php echo $html->link($event['name'],array ('controller' => 'admins', 'action' => 'event' , $event['id']))?></h2>
		<?php endif; ?>
		
		<?php if ($steps = $this->requestAction('admins/steps/'.$this->params['pass'][0])) :?>
			<ol id="adminSteps">
				<?php foreach($steps as $step): ?>
					<li class="<?php echo $step['classes']; ?>">
						<?php echo $html->link($step['admin_label'], array('controller' => 'admins', 'action' => 'eventindex', strtolower($step['controller']). '/index'));?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif;?>
	</div>
</div>
