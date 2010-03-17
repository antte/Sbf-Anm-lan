<ul id="validationErrors" class="message">
<?php 
	if (!empty($errors)) {
		foreach ($errors as $error):
?>
	<li><?php echo $error; ?></li>
<?php 
	endforeach;
	}
?>
</ul>