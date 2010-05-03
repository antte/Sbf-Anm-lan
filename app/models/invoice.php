<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');

	
	function calculatePrice($price, $amountOfPeople) {
		return $price * $amountOfPeople;
	}
	
	
}
	
	
