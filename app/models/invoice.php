<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');
		var $exportAllowed = true;
		var $altName = 'Fakturor';
		
		function calculatePrice($price, $amountOfPeople) {
			return $price * $amountOfPeople;
		}
	}