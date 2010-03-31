<?php

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	var $components = array('Email');
	
	function index() {
		if (isset($this->params['requested'])) return $this->getRegistration();
	}
	
	/**
	 * Finalizes the registration saving it and emailing it to the registrator
	 */
	function finalize() {
		
		// The only thing registration needs right now is an event id
		$Registration['Registration']['event_id'] = $this->Session->read('Registration.Registration.event_id');
		$Registration['Registration']['number'] = $this->Registration->generateUniqueNumber();
		$this->saveModelDataToSession('Registration', $Registration);		
		$registration = $this->Session->read('Registration');
		//debug($registration);
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registration');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		} else {
			$this->Session->write('registrationId', $this->Registration->id);
			$this->sendRegistrationConfirmMail($registration['Registrator'], $registration['Registration']);
			$this->Session->del('Registration');
			$this->redirect(array ('action' => 'receipt'));
		}
	}

	/**
	 * Sending a comfirmmail using the reciept view for layout
	 * @param unknown_type $registrator --session array for the registration module 
	 * @param unknown_type $registration -- session array for the registration module
	 */
	private function sendRegistrationConfirmMail($registrator,$registration){
		$this->Email->smtpOptions = array(
			'port'			=> '25', 
			'timeout'		=> '30',
			'host' 			=> 'localhost'
		);
		
		$this->Email->delivery 	= 'smtp';
		
		$this->Email->from		= 'noreply@sbf.se';
		$this->Email->to		= "{$registrator['first_name']} {$registrator['last_name']} <{$registrator['email']}>";
		$this->Email->bcc		= "it sbf <it@sbf.se>";
		$this->Email->replyTo	= 'it@sbf.se';
		
		$event = $this->Registration->Event->findById($registration['event_id'], array('fields' => 'name'));
		
		$this->Email->subject	= "Kvitto för din anmälan till {$event['Event']['name']}";
		$this->Email->template	= 'receipt';
		$this->Email->sendAs	= 'both'; //both text and html
		$this->Email->send();
	}
	
	function review(){
		
	}
	
	function receipt() {
		
	}
	
	/**
	 * Clear the session from data regarding Registration   
	 * TODO remove at deploy
	 */
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create', 'controller' =>'registrator'));
	}
	
	/**
	 * 
	 */
	private function getRegistration() {
		/* if a registration has been made recently we return it
		 * we need to take into account that this action can be requested both before and after a registration has been saved
		 */
		
		// if Registration exists the registration hasn't been saved yet and the user is reviewing his registration
		$registration = $this->Session->read('Registration');
		
		//if it isnt in session we try to find it in db
		// registrationId is set when saving the registration so we take that as indication its saved in db already
		if(!$registration && $this->Session->read('registrationId')) {
			$registration = $this->Registration->findById($this->Session->read('registrationId'));
		}
		
		if ($registration) {
			//something has been added (we have either collected registration from session or from db)
			$registration[] = $this->Registration->Event->find('first', array('conditions' => array('id' => $registration['Registration']['event_id'])));
			return $registration;
		}
		
		//the user isn't making a registration so we send the requester all registrations
		return $this->Registration->find('all');
	}
}

