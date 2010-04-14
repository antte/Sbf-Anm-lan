<?php $registration = $this->requestAction('registrations/index');?>
<?php //$event = $this->requestAction('registrations/getEvent');?>

<div id="booking_nr" class="grid_8">
	<div class="grid_full">
	  	<h2><?php echo 'Gala';?></h2>
		<?php if(isset($registration['Registration']['number'])){?>
			<p class="booking_nr">Bokningsnummer: <?php echo $registration['Registration']['number']?></p>
		<?php } ?>
		<?php if( isset($registration['Registration']['created']) && isset($registration['Registration']['modified']) ){?>
			<?php if ( $registration['Registration']['created'] !== $registration['Registration']['modified'] ){?>
				<?php //if created and modified is the same the registration was just created and the user isn't interested ?>
				<p class="datetime">		Skapad: 		<?php echo $registration['Registration']['created']?></p>
				<p class="datetime">		Senast ändrad: 	<?php echo $registration['Registration']['modified']?></p>
			<?php } ?>
		<?php } ?>
	</div>
</div>