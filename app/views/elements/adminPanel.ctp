<?php 
echo $html->css('adminPanel');

$steps = $this->requestAction('admins/steps');

?>

<div id="adminPanel" class="grid_full">

<?php echo $html->link( 'Logga ut', array('controller' => 'admins', 'action' => 'logout'), array( 'class' => 'logout') );?>

<ol id="adminSteps">
	<?php foreach($steps as $step): ?>
		<li class="<?php echo $step['classes']; ?>">
			<?php echo $html->link($step['label'], array('controller' => $step['controller'], 'action' => $step['action']));?>
		</li>
	<?php endforeach; ?>
</ol>
</div>