<?php $event = $this->requestAction('events/receipt');?>

<div id="receipt_info" class="grid_4">
	<div class="grid_full">
		<h2>Tack för din anmälan!</h2>
		<p><?php echo $event['Event']['confirmation_message']?></p>
		<p class="general_info">Du har fått denna information mailad till din email du angav.</p>
		<p><a href="javaScript:window.print();" class="print">Skriv gärna ut denna bekräftelse</a> och spara den. Du kan även ändra i din beställning vid ett senare tillfälle genom att använda vårt inloggningssystem.</p>
	</div>
</div>