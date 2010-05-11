<?php
	class InvoicesController extends AppController {
	var $altName = 'Fakturor';
	var $altDescribe = 'Fakturor som listas';
		
		/**
		 * Calculate the sum of the people based on price_per_person from current event and amount of people in current registration
		 * @return sum of registration.
		 */
		function getSum($internal = null) {
			
			if(!isset($this->params['requested'])) return;
			
			//Get current active registration
			$registration = $this->requestAction('registrations');
			//Get current active event
			$event = $this->requestAction('events');
			$pricePerPerson = $this->Session->read('Event.price_per_person');
				
			if($internal === null) { //normal use case unchanged so that it can be called in the same way as before from person element
				
				if($this->Session->check('Registration.Person') && $this->Session->check('Event.price_per_person')) {
					$amountWithReductionCode = 0;
					foreach ($registration['Person'] as $person){
						if (isset($person['reduction_code_id']) && $person['reduction_code_id'] > 0)
							$amountWithReductionCode++;
					}
					$amountOfPeople = (sizeof($registration['Person'])) - $amountWithReductionCode;
					//TODO refactor shouldnt we use price from event that we requested above?
					return $this->Invoice->calculatePrice($pricePerPerson, $amountOfPeople);
				} else {
					// We get here when we are in receipt view basicly
					$latestInvoice = $this->Invoice->getLatest($registration['Registration']['id']);
					return $latestInvoice['Invoice']['price'];
				}
			} elseif($internal) {
				
				$sum = 0;
				
				//return only sum of all the internal people (people that has a role where is_external is false/null/0)
				foreach($registration['Person'] as $person) {
					if(isset($person['is_external'])) {
						if(!$person['is_external']) {
							$sum += $pricePerPerson;
						}
					}
				}
				
				return $sum;
				
			} else {
				
				$sum = 0;
				
				//return only sum of all the external people (people that has a role where is_external is true/1)
				foreach($registration['Person'] as $person) {
					if($person['is_external']) {
						$sum += $pricePerPerson;
					}
				}
				
				return $sum;
				
			}

		}
		
		
		function getLatest($registrationId){
			return $this->Invoice->getLatest($registrationId);
		}
		
		
	}