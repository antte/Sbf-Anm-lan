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
		//$this->layout='registration';
		// The only thing registration needs right now is an event id
		$Registration['Registration']['event_id'] = $this->Session->read('Registration.Registration.event_id');
		$Registration['Registration']['number'] = $this->Registration->generateUniqueNumber();
		$this->saveModelDataToSession('Registration', $Registration);		
		$registration = $this->Session->read('Registration');
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registration');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		} else {
			$this->Session->write('Event.registrationId', $this->Registration->id);
			$this->sendRegistrationConfirmMail($registration['Registrator'], $registration['Registration']);
		    
			$steps = $this->Session->read('Event.steps');
			foreach($steps as &$step) {
				$step['current_step'] = false;
			}
			$steps['Receipt']['current_step'] = true;
			$this->Session->write('Event.steps', $steps);
			$this->Session->del('Registration');
			$this->redirect(array ('controller'=> 'registrations' , 'action' => 'receipt'));
		}
	}

	function review(){
		$this->layout='registration';
	}
	
	function receipt() {
		$this->layout='registration';
	}
	
	//recieve and process login credentials
	function login() {
		
	}
	
	/**
	 * Clear the session from data regarding Registration   
	 * TODO remove at deploy
	 */
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->del('Event');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('controller' =>'events', 'action' => 'index'));
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
		
		$event = $this->Session->read('Event');
		$this->Email->subject	= "Kvitto för din anmälan till {$event['name']}";
		$this->Email->template	= 'default';
		$this->Email->sendAs	= 'both'; //both text and html
		$this->Email->send();
	}
	
	
	/**
	 * if a registration has been made recently we return it
	 * we need to take into account that this action can be requested both before and after a registration has been saved
	 */
	private function getRegistration() {
		
		// if Registration exists the registration hasn't been saved yet and the user is reviewing his registration
		$registration = $this->Session->read('Registration');
		
		// if it isnt in session we try to find it in db
		// registrationId is set when saving the registration so we take that as indication its saved in db already
		if(!$registration && $this->Session->read('Event.registrationId')) {
			$registration = $this->Registration->findById($this->Session->read('Event.registrationId'));
			$eventData = $this->Registration->Event->find('first', array('conditions' => array('id' => $registration['Registration']['event_id'])));
			$registration['Event'] = $eventData['Event'];
		}
		
		if ($registration) {
			//something has been added (we have either collected registration from session or from db)
			return $registration;
		}
		
		//the user isn't making a registration so we send the requester all registrations
		return $this->Registration->find('all');
	}

	function getEvent(){
		
		if (isset($this->params['requested'])) {
			return $this->Session->read('Event');
		}
		
		
	}
}


