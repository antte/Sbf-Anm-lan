<?php $registration = $this->requestAction('Registrations/receipt');?>
<div id="booking_nr" class="grid_8">
	<div class="grid_full">
		<p class="booking_nr">Event : <?php echo $registration['event_name']?></p><p class="booking_nr">Bokningsnummer:<?php echo $registration['number']?></p>

	</div>
</div>