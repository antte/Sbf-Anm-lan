<!-- Help class that includes this js file even thou we are not in head tag -->
<?php 
	echo $javascript->link('jquery.1.4.2-min', $inline = false);
	echo $javascript->link('jquery.validate', $inline = false);
	echo $javascript->link('jq.form.conf/messages_se', $inline = false);
?>
<div class="grid_12">
	<div class="grid_full">
		<h2>Prisuppgifter och rabattkoder för <?php echo $eventName;?></h2>
	</div>
</div>
<div id="reduction_codes" class="grid_8">
	
	<?php 
		if (!empty($errors)) {?>
			<ul id="validationErrors" class="message">
				<?php foreach ($errors as $key => $error): ?>
					<li>
						<?php echo $error; ?>
					</li>
				<?php endforeach;?>			
			</ul>
		<?php } ?>
		
</div> 

<noscript>
	<div id="javascript_info" class="grid_4" >
		<div class="grid_full">
			<h2>Information</h2>
			<p>
				<em>För bästa funktionalitet rekommenderas att ni sätter på JavaScript - annars kan information gå förlorad vid felaktigt införda värden i formulären.</em> 
			</p>
		</div>
	</div>
</noscript>