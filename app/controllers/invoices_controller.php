<?php
	class InvoicesController extends AppController {
	var $altName = 'Fakturor';
	var $altDescribe = 'Fakturor som listas';
		
		/**
		 * Calculate the sum of the people based on prize_per_person from current event and amount of people in current registration
		 * @return sum of registration.
		 */
	
		function getSum() {
			//Get current active registration
			$registration = $this->requestAction('registrations');
			//Get current active event
			$event = $this->requestAction('events');
			
			if($this->Session->check('Registration.Person') && $this->Session->check('Event.price_per_person')) {
				$amountWithReductionCode = 0;
				foreach ($registration['Person'] as $person){
					if (isset($person['reduction_code_id']) && $person['reduction_code_id'] > 0)
						$amountWithReductionCode++;
						 
				}
				$amountOfPeople = (sizeof($registration['Person'])) - $amountWithReductionCode;
				return $this->Invoice->calculatePrice($this->Session->read('Event.price_per_person'), $amountOfPeople);
			} else {
				// We get here when we are in receipt view basicly
				$latestInvoice = $this->Invoice->getLatest($registration['Registration']['id']);
				return $latestInvoice['Invoice']['price'];
			}
				
		}
		
		function getLatest($registrationId){
			return $this->Invoice->getLatest($registrationId);
		}
		
		
	}