<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');
		var $exportAllowed = true;
		var $altName = 'Fakturor';
		var $expiryTime = 2592000; //30 days
		
		function calculatePrice($price, $amountOfPeople) {
			return $price * $amountOfPeople;
		}
		
		function getLatest($registrationId) {
			return $this->find('first', array('order' => 'Invoice.created DESC', 'limit' => '1', 'recursive' => -1 , 'condition' => array('Invoices.registration_id' => $registrationId)));
		}
		
		/**
		 * Builds an invoice from registration data and adds it to the registration and then returns it
		 * @param $registration
		 * @param $isChange
		 */
		function addInvoiceToRegistration($registration) {
			
			//if registration id exists this is an existing registration and we need to add the invoice last to the invoices array
			if(isset($registration['Registration']['id'])) {
				
				//We have to get all previous invoices (if any) and add them to the array so they get saved again
				$invoices = $this->find('all', array('registration_id' => $registration['Registration']['id'], 'recursive' => -1));
				$registration['Invoice'] = $invoices;
				
				$newIndex = sizeof($invoices);
				
			} else {
				$newIndex = 0;
			}
			
			$registration['Invoice'][$newIndex]['price'] = $this->requestAction('invoices/getSum');
			$registration['Invoice'][$newIndex]['expiry_date'] = $this->generateExpiryDate();
			
			return $registration;	
		}
		
		function generateExpiryDate() {
			return date('Y-m-d H:i:s', (mktime() + $this->expiryTime));
		}
		
	}