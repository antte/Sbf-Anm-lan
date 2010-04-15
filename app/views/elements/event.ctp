<?php $registration = $this->requestAction('registrations');?>
<div id="receipt_info" class="grid_4">
	<div class="grid_full">
		<?php if( $registration['Registration']['created'] == $registration['Registration']['modified'] ){?>
			<?php //if created and modified is the same the registration was just created ?>
			<h2>Tack för din anmälan!</h2>
		<?php } else { ?>
			<?php //if created and modified is not the same the registration is changed and we let the user know that ?>
			<h2>Din anmälan är nu ändrad!</h2>
		<?php } ?>
		<p><?php echo $registration['Event']['confirmation_message']?></p>
		<p class="general_info">
			Du har fått denna information mailad till den email du angav. Om du inte har fått mailet kontrollera din skräppost eller <a href="mailto:it@sbf.se">kontakta support it@sbf.se</a>.
		</p>
		<p><a href="javaScript:window.print();" class="print">Skriv gärna ut denna bekräftelse</a> och spara den. Du kan även ändra i din beställning vid ett senare tillfälle genom att använda vårt inloggningssystem.</p>
	</div>
</div>