<?php

class RegistrationsController extends AppController {
	
	var $components = array('Email');
	
	/**
	 * Finalizes the registration (saving it)
	 */
	function finalize() {
		
		// The only thing registration needs right now is an event id
		$Registration['Registration']['event_id'] = $this->Session->read('eventId');
		$Registration['Registration']['number'] = $this->Registration->generateUniqueNumber();
		debug($this->Registration->generateUniqueNumber(1));
		
		$this->saveModelDataToSession('Registration', $Registration);
		
		$registration = $this->Session->read('Registration');
		
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registration');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
		
		/*$this->Email->from		= 'Svenska bilsportförbundet <info@sbf.se>';
		$this->Email->to		= "{$registration['Registrator']['first_name']} {$registration['Registrator']['last_name']} <{$registration['Registrator']['email']}>";
		$eventName = $this->Registration->Event->findById($eventId['Registration']['event_id'], array('fields' => 'name'));
		$this->Email->subject	= "Kvitto för din anmälan till $eventName";
		$this->Email->template	= 'receipt';
		$this->Email->sendAs	= 'both'; //both text and html
		$this->set('registration', $registration);
		$this->Session->del('Registration');
		$this->Email->send();*/
	}
	
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create'));
	}
	
	function receipt() {
		
	}
	
	function testemail() {
		$this->Email->from    = 'hilol <andreas.fliesberg@gmail.com>';
		$this->Email->to      = 'an <andreas_fliesberg@hotmail.com>';
		$this->Email->subject = 'Test';
		$this->Email->send('Hello message body!');
	}
	
}
