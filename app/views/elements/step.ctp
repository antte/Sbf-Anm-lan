<?php $steps = $this->requestAction("steps/index/". $this->params['controller'] . "/". $this->params['action']); 
//debug($this->requestAction('steps/debug'));
?>

<ol id="rocket" class="grid_full">
	<?php $i = 0;?>
	<?php foreach($steps as $step): ?>
		<li class="<?php echo $step['classes'];?>">
			<span class="leftArrow"></span><?php //we need to create a dummy that can contain one of the arrows (the left arrow)?>
			<?php 
			//if the step is the current step or a coming step we dont want the user to be able to klick it
			if ( preg_match('/^coming/', $step['classes']) || preg_match('/^current/', $step['classes'])){
				echo '<span class="expander">';
				echo $step['label'];
				echo '</span>'; 
			} elseif (preg_match('/^disabled/', $step['classes'])){
				echo '<span class="disabled">';
				echo $step['label'];
				echo '</span>'; 
			} else { 
				echo $html->link($step['label'], array('controller' => $step['controller'], 'action' => $step['action']));
			}?>
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
</ol>