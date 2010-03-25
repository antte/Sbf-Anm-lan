<?php

class RegistrationsController extends AppController {
	
	var $components = array('Email');
	
	/**
	 * Finalizes the registration (saving it)
	 */
	function finalize() {
		
		// The only thing registration needs right now is an event id
		$eventId['Registration']['event_id'] = $this->Session->read('eventId');
		$this->saveModelDataToSession('Registration', $eventId);
		
		$registration = $this->Session->read('Registration');
		
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
		
		$this->Email->from		= 'Svenska bilsportförbundet <info@sbf.se>';
		$this->Email->to		= "{$registration['Registrator']['first_name']} {$registration['Registrator']['last_name']} <{$registration['Registrator']['email']}>";
		$eventName = $this->Registration->Event->findById($eventId['Registration']['event_id'], array('fields' => 'name'));
		$this->Email->subject	= "Kvitto för din anmälan till $eventName";
	}
	
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create'));
	}
	
}