<div class="grid_12">
	<div class="grid_full">
		<table id="registrations">
		<?php foreach($event['Registration'][0] as $columnName => $value): ?>
			<?php //the first registration so we can print table headers ?>
			<?php $tableHeaders[] = $columnName; ?>
		<?php endforeach; ?>
		<?php echo $html->tableHeaders($tableHeaders); ?>
		<?php echo $html->tableCells($event['Registration']); ?>
		</table>
	</div>
</div>