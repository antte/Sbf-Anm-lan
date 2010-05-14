<?php // $invoiceId = $this->requestAction('invoices/getInvoiceId')?>
<?php $items = $this->requestAction('invoices/getItems/' . 9);?>


<div id="item" class="grid_8">
	<div class="grid_full">
		<table id="item_info">
			<tr>
				<th>Beskrivning</th>
				<th>Pris</th>
			</tr>
			<?php foreach ($items as $item) : ?>
			<tr>			
				<td><?php echo $item['Item']['description'] ?></td>
				<td><?php echo $item['Item']['price']?></td>
			</tr>
			<?php endforeach;?>
			<tr>
				<th class="sum">Summa </th>
				<th><?php echo $this->requestAction('invoices/getSumPrice/' . 9 )?> </th>
			</tr>
		</table>
	</div>
</div>
