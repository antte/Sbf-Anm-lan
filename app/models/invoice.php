<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');
		var $exportAllowed = true;
		var $altName = 'Fakturor';
		
		function calculatePrice($price, $amountOfPeople) {
			return $price * $amountOfPeople;
		}
		
		function getLatest($registrationId) {
			return $this->find('first', array('order' => 'Invoice.created DESC', 'limit' => '1', 'recursive' => -1 , 'condition' => array('Invoices.registration_id' => $registrationId)));
		}
		
	}