<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');
	}
	
	function calculateInvoiceSum() {
	 	$invoice = $this->Event->find('all', array(
	 		'contain' => array(
	 		'Events' => array(
	 		'fields' => array('SUM(Events.price_per_person')))));
	 	debug($invoice);
	 }