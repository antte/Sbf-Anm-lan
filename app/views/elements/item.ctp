<?php $price = $this->requestAction('invoices');?>
<?php $description = $this->requestAction('');?>
<?php $invoiceId = $invoice['Invoice']['id']?>
<?php $item = $this->requestAction('invoices/getItem' . $invoiceId)?>

<div id="item" class="grid_8">
	<div class="grid_full">
		<dl id="item_info">
			<dt>Beskrivning</dt>
			<dd><?php echo $description?></dd>
			<dt>Pris</dt>
			<dd><?php echo $price?></dd>
		</dl>
	</div>
</div>
