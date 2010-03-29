<?php

class RegistrationsController extends AppController {
	
	var $components = array('Email');
	
	/**
	 * Finalizes the registration saving it and emailing it to the registrator
	 */
	function finalize() {
		
		// The only thing registration needs right now is an event id
		$Registration['Registration']['event_id'] = $this->Session->read('Registration.Registration.event_id');
		$kolla = $Registration['Registration']['number'] = $this->Registration->generateUniqueNumber();
		$this->saveModelDataToSession('Registration', $Registration);		
		$registration = $this->Session->read('Registration');
		//debug($registration);
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registration');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		} else {
		
			$this->Email->smtpOptions = array(
				'port'			=> '25', 
				'timeout'		=> '30',
				'host' 			=> 'localhost'
			);
			
			$this->Email->delivery 	= 'smtp';
			
			$this->Email->from		= 'noreply@sbf.se';
			$this->Email->to		= "{$registration['Registrator']['first_name']} {$registration['Registrator']['last_name']} <{$registration['Registrator']['email']}>";
			$this->Email->bcc		= "it sbf <it@sbf.se>";
			
			$event = $this->Registration->Event->findById($registration['Registration']['event_id'], array('fields' => 'name'));
			
			$this->Email->subject	= "Kvitto för din anmälan till {$event['Event']['name']}";
			$this->Email->replyTo	= 'it@sbf.se';
			$this->Email->template	= 'receipt';
			$this->Email->sendAs	= 'both'; //both text and html
			$this->Email->send();
			$this->Session->write('registrationId', $this->Registration->id);
			// When the registration is finished we clear the session.
			$this->Session->del('Registration');
			$this->redirect(array ('action' => 'receipt'));
		}
	}
	
	/**
	 * Clear the session from data regardin Registration   
	 * TODO remove at deploy
	 */
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create', 'controller' =>'registrator'));
	}
	
	/**
	 * Get information about a registration suitet for use in element
	 * return $registration array of registration information 
	 */
	function receipt() {
		$registrationData = $this->Registration->findById($this->Session->read('registrationId'));
		$registration['number'] = $registrationData['Registration']['number'];
		$registration['event_name'] = $registrationData['Event']['name'];
		return $registration;
		
	}
}

