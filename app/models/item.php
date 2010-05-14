<?php 
	class Item extends AppModel {
		var $belongsTo = array('Invoices');
	
	function getItem($invoiceId) {
		return $this->find('first', array('order' => 'Item.id DESC', 'limit' => '1', 'recursive' => -1, 'conditions' => array('Items.event_id' => $invoiceId)));
	}
	
	
	}
	
	
	
	
	?>
	
	
	