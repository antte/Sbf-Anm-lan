<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');
		var $exportAllowed = true;
	
		function calculatePrice($price, $amountOfPeople) {
			return $price * $amountOfPeople;
		}
	}