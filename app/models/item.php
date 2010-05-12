<?php 
	class Item extends AppModel {
		var $belongsTo = array('Invoices');
	
	function getItem($invoiceId) {
		return $this->find('first', array());
	}
	
	
	}
	
	
	
	
	?>
	
	
	