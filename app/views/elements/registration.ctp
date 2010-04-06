<?php $registration = $this->requestAction('registrations/index');?>
<?php $event = $this->requestAction('registrations/getEvent');?>
<!--  <h1><?php echo $event['name']?></h1> -->
<div id="booking_nr" class="grid_8">
	<div class="grid_full">
		<h2><?php echo $event['name']?></h2>
		<?php if(isset($registration['Registration']['number'])){?>
			<p class="booking_nr">Bokningsnummer: <?php echo $registration['Registration']['number']?></p>
		<?php } ?>
	</div>
</div>