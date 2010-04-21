<div id="adminEvent" class="grid_12">
	<div class="grid_full">
		<dl>
		<?php foreach($event['Event'] as $key => $value): ?>
			<dt><?php echo $key;?></dt>
			<dd><?php echo $value;?></dd>
		<?php endforeach;?>
		</dl>
	</div>
</div>