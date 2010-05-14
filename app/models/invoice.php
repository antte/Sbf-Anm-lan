<?php 
	class Invoice extends AppModel {
		var $belongsTo = array('Registration');
		var $hasMany = array(
			'Person'
		);
		var $exportAllowed = true;
		var $altName = 'Fakturor';
		var $expiryTime = 2592000; //30 days
		
		function calculatePrice($price, $amountOfPeople) {
			return $price * $amountOfPeople;
		}
		
		function getLatest($registrationId) {
			return $this->find('first', array('order' => 'Invoice.created DESC', 'limit' => '1', 'recursive' => -1 , 'conditions' => array('Invoices.registration_id' => $registrationId)));
		}
		
		/**
		 * Builds an invoice from registration data and adds it to the registration and then returns it
		 * @param $registration
		 * @param $isChange
		 */
		function createAndAddInvoicesToRegistration($registration) {
			
			//We need to create two invoices depending on the payment method of each person (which depends on role)
			$externalPeople = array();
			$internalPeople = array();
			
			foreach($registration['Person'] as $person) {
				if($isExternal = $this->Registration->Person->Role->field('is_external', array('id' => $person['role_id']))) {
					$externalPeople[] = $person;
				} else {
					$internalPeople[] = $person;
				}
			}
			
			//if registration id exists this is an existing registration and we need to add the invoice last to the invoices array
			if(isset($registration['Registration']['id'])) {
				
				//We have to get all previous invoices (if any) and add them to the array so they get saved again
				$invoices = $this->find('all', array('registration_id' => $registration['Registration']['id'], 'recursive' => -1));
				$registration['Invoice'] = $invoices;
				
				$newIndex = sizeof($invoices);
				
			} else {
				$newIndex = 0;
			}
			
			//TODO this isnt very DRY
			if			(!is_empty($externalPeople) && is_empty($internalPeople)) {
				
				//we only have external people
				$registration['Invoice'][$newIndex]['expiry_date'] = $this->generateExpiryDate();
				foreach($externalPeople as $person) {
					$registration['Invoice'][$newIndex]['Item'][] = $this->Invoice->Registration->Person->toItem($person);
				}
							
			} else if 	(!is_empty($internalPeople) && is_empty($externalPeople)) {
				
				//we only have internal people
				$registration['Invoice'][$newIndex]['expiry_date'] = $this->generateExpiryDate();				
				foreach($internalPeople as $person) {
					$registration['Invoice'][$newIndex]['Item'][] = $this->Invoice->Registration->Person->toItem($person);
				}
				
			} else if 	(!is_empty($externalPeople) && !is_empty($internalPeople)) {
				
				//we have both
				
				$registration['Invoice'][$newIndex]['expiry_date'] = $this->generateExpiryDate();
				foreach($externalPeople as $person) {
					$registration['Invoice'][$newIndex]['Item'][] = $this->Invoice->Registration->Person->toItem($person);
				}
				
				$registration['Invoice'][($newIndex+1)]['expiry_date'] = $this->generateExpiryDate();	
				foreach($internalPeople as $person) {
					$registration['Invoice'][$newIndex+1]['Item'][] = $this->Invoice->Registration->Person->toItem($person);
				}			
				
			} else {
				//TODO some kind of error?
			}
			
			return $registration;	
		}
		
		function generateExpiryDate() {
			return date('Y-m-d H:i:s', (mktime() + $this->expiryTime));
		}
		
	}