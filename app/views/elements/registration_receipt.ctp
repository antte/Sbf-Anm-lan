<?php $registration = $this->requestAction('Registrations/receipt');?>
<h1><?php echo $registration['event_name']?></h1>
<div id="booking_nr" class="grid_8">
	<div class="grid_full">
		<p class="booking_nr">Bokningsnummer: <?php echo $registration['number']?></p>
	</div>
</div>