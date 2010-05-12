<?php $bank_giro = $this->requestAction('events/getBankgiroNumber'); ?>
<?php $registration = $this->requestAction('registrations'); ?>
<?php 
	$registrationId = $registration['Registration']['id'];
	$invoice = $this->requestAction('invoices/getLatest/' . $registrationId); 
?>

<div id="invoice" class="grid_8">
	<div class="grid_full">
		<h2>Fakturainformation</h2>
		<p>När du genomför din betalning till oss behöver du ange dessa uppgifter.</p>
		<dl id="invoice_info">
		
			<dt>Bankgironummer</dt>
			<dd><?php echo $bank_giro; ?></dd>
			
			<dt>OCR/Fakturanummer</dt>
			<dd><?php echo $registration['Registration']['number']?></dd>
			
			<dt>Förfallodatum</dt>
			<dd><?php echo $date->SE($invoice['Invoice']['expiry_date'], true);?></dd>
		</dl>
		<p><em>Du får en bekräftelse från oss när vi har mottagit din betalning.</em></p>
	</div>
</div>