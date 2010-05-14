<?php 
	class Item extends AppModel {
		
		var $belongsTo = array('Invoice');
	
		function getItem($invoiceId) {
			return $this->find('first', array('order' => 'Item.id DESC', 'limit' => '1', 'recursive' => -1, 'conditions' => array('Items.event_id' => $invoiceId)));
		}
		
		function beforeSave() {
			debug("before item save");
			debug($this->data);
			//debug($this->Invoice->id);
			//$this->data['Item']['invoice_id'] = $this->Invoice->id;
			//debug($this->data);
			return true;
		}
		
		function afterSave() {
			debug("after item save");
			debug($this->validationErrors);
		}
		
	}