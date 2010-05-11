<?php $bankgiro = $this->requestAction('events/getBankgiroNumber'); ?>
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
			<dd><?php echo $bankgiro; ?></dd>
			
			<dt>OCR/Fakturanummer</dt>
			<dd><?php echo $registration['Registration']['number']?></dd>
			
			<dt>Förfallodatum</dt>
			<dd><?php echo $invoice['Invoice']['expiry_date']; ?></dd>
			
		</dl>
		<p><em>Bokningen ska betalas in inom 30 dagar netto fr.o.m. beställningsdatumet. Du får en bekräftelse från oss när vi har mottagit din betalning.</em></p>
	</div>
</div>