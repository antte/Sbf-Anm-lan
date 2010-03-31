<?php $registration = $this->requestAction('registrations');?>
<h1><?php echo $registration['event_name']?></h1>
<div id="booking_nr" class="grid_8">
	<div class="grid_full">
		<h2><?php echo $registration['event_name']?></h2>
		<?php if(isset($registration['number'])){?>
			<p class="booking_nr">Bokningsnummer: <?php echo $registration['number']?></p>
		<?php } ?>
	</div>
</div>