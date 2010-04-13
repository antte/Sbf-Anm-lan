<?php

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	var $components = array('Email');
	
	function index() {
		if (isset($this->params['requested'])) return $this->getRegistration();
	}
	
	/**
	 * Finalizes the registration, saving it and emailing it to the registrator
	 */
	function finalize() {
		// The only thing registration needs right now is an event id
		$registration['event_id'] = $this->Session->read('Registration.Registration.event_id');
		$registration['number'] = $this->Registration->generateUniqueNumber();
		//debug($registration);
		
		$this->saveModelDataToSession($this,$registration);
		$this->updateStepState('Registrations' , 'review');
		$registration = $this->Session->read('Registration');
		$event = $this->Session->read('Event');
		//debug($registration);
		
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registration');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		} else {
			$this->Session->write('Event.registrationId', $this->Registration->id);
			//$this->sendRegistrationConfirmMail($event, $registration['Registrator']);
			$this->Session->del('Registration');
			$this->redirect(array ('controller'=> 'registrations' , 'action' => 'receipt'));
		}
	}
	
	/*
	 * Inits the review mode
	 */
	function review(){
		$this->layout='registration';
		
		//you can't be in review if you haven't finished previous steps
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}
		
		//make review done as soon as we get there
		$this->updateStepState($this->params['controller'] , $this->params['action']);
		
	}
	
	/*
	 * Inits the receipt view for the whole registration
	 */
	function receipt() {
		$this->layout='registration';
		
		//you can't be in receipt if you haven't finished previous steps
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}						
	}
	
	/*
	 * Recieve and process login credentials, fetches and stores the registration to session and redirects to review
	 */
	function login() {
		if(!$this->data) {
			// First time visiting the site, do nothing and just display the view
		} else {
			
			// Sanitize the input data
			$number = Sanitize::clean($this->data['Registration']['number']);
			$email = Sanitize::clean($this->data['Registrator']['email']);
			
			// Get an array from the database with all the info on the registration
			if($registration = $this->Registration->findByNumber($number)){
				
				// Checks the array from the database and tries to match the email with the form
				if($registration['Registrator']['email'] == $email){
					
					// Retype email is not stored in the database, so we add it to the array
					$registration['Registrator']['retype_email'] = $registration['Registrator']['email'];
					
					$this->Session->write('Registration', $registration);
					$this->redirect(array('action' => 'review'));
					
				} else {
					//the user has put in wrong values in the field 'email'
					$this->set('error', 'wrongvalue');
				}
				
			} else {
				//the user has put in wrong values in at least the 'booking number' field
				$this->set('error', 'wrongvalue');
			}
			
		}
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
	private function sendRegistrationConfirmMail($event,$registrator){
		debug($this->Session->read());
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
	
	
	/*
	 * Returns the event from session
	 * @return array
	 */
	function getEvent(){
		
		if (isset($this->params['requested'])) {
			return $this->Session->read('Event');
		}
		
		
	}
}


