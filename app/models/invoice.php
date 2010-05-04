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
		
		/**
		 * 
		 * @param $registration
		 * @param $isChange
		 */
		function addInvoiceToRegistration($registration) {
			
			//if registration id exists this is an existing registration and we need to add the invoice it last to the invoices array
			if(isset($registration['Registration']['id'])) {
				
				//We have to get all previous invoices (if any) and add them to the array so they get saved again
				$invoices = $this->find('all', array('registration_id' => $registration['Registration']['id'], 'recursive' => -1));
				
				$invoices[sizeof($invoices)]['price'] = $this->requestAction('invoices/getSum');
				
				$registration['Invoice'] = $invoices;
				
			} else {
				//Creating an Invoice so it gets saved with the registration
				$registration['Invoice'][0]['price'] = $this->requestAction('invoices/getSum');
			}
			return $registration;	
		}
		
	}