<?php 
	class Item extends AppModel {
		var $belongsTo = array('Invoice');
	
	function getItems($invoiceId) {
		return $this->find('all', array( 'recursive' => -1, 'conditions' => array('Item.invoice_id' => $invoiceId)));
	}
	
	function getSumPrice($invoiceId){
		$prices = $this->query('SELECT sum(price) as Sum FROM items WHERE invoice_id = '.$invoiceId . ';');
		return $prices[0][0]['Sum'];
	}	
}
	
	
	
	
	