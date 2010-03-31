<?php $registration = $this->requestAction('registrations');?>
<?php debug($registration)?>
<h1><?php echo $registration['Event']['event_name']?></h1>
<div id="booking_nr" class="grid_8">
	<div class="grid_full">
		<h2><?php echo $registration['Event']['event_name']?></h2>
		<?php if(isset($registration['Event']['number'])){?>
			<p class="booking_nr">Bokningsnummer: <?php echo $registration['number']?></p>
		<?php } ?>
	</div>
</div>