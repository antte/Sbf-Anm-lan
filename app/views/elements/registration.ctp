<?php $registration = $this->requestAction('registrations/index');?>
<?php $event = $this->requestAction('events/index/'. $registration['Registration']['event_id']);?>
<div id="booking_nr" class="grid_8">
	<div class="grid_full">
	  	<h2><?php echo $event['name'];?></h2>
		<?php if(isset($registration['Registration']['number'])){?>
			<p class="booking_nr">Bokningsnummer: <?php echo $registration['Registration']['number']?></p>
		<?php } ?>
	</div>
</div>