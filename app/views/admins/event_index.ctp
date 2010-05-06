<?php 
	if (!empty($errors)) {?>
		<div class="grid_12">
			<ul id="validationErrors" class="admin_info">
				<?php foreach ($errors as $key => $error): ?>
					<li>
						<?php echo $error; ?>
					</li>
				<?php endforeach;?>			
			</ul>
		</div>
	<?php } ?>

<?php echo $this->element($elementDir);?>