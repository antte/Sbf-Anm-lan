<?php
	class InvoicesController extends AppController {
		
		function saveDataToSession($sum) {
			
			if($this->Session->check('Registration.Invoice')) {
				// TODO check for duplicate
				$invoices = $this->Session->read('Registration.Invoice');
				$this->Session->write('Registration.Invoice.'. sizeof($invoices) .'.price', $sum);
			} else {
				$this->Session->write('Registration.Invoice.0.price', $sum);
			}
			
		}
		
		function getSum() {
			
			$registration = $this->requestAction('registrations');
			$event = $this->requestAction('events');
			debug($registration);
			
			if(!$this->Session->check('Registration.Invoice.0')) {
				$latestInvoice = $this->Invoice->getLatest($registration['Registration']['id']);
				return $latestInvoice['Invoice']['price'];
			} else {
				return $this->Invoice->calculatePrice($event['price_per_person'], sizeof($registration['Person']));
			}
			
		}
		
	}