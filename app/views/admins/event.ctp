<?php 
	//testdata
	$event['id'] 		= 33;
	$event['name'] 		= "Galen";
	$event['is_active']	= 1;
	$event['confirmation_message'] 		= "asdgasdgfhgjhujhgfds";
?>
<dl id="event">
<?php foreach($event as $key => $value): ?>
	<dd><?php echo $key;?></dd>
	<dt><?php echo $value;?></dt>
<?php endforeach;?>
</dl>