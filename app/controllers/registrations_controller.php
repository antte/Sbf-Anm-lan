<?php

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	var $components = array('Email');
	
	function index() {
		if (isset($this->params['requested'])) return $this->getRegistration();
		
		//Link to index and this will take you to the right step.
		$this->requestAction('steps/redirectToNextUnfinishedStep');
	}
	/**
	 * Saves Registration.Registration To Session and save and email the whole Registration
	 * @param unknown_type $action
	 */
	function add($action = null){
		// Check if there already exists a booking number means that this is a editation of existing booking,	
		if ($this->Session->check('Registration.Registration.number')){
			//Set the modified date for the editation
			$this->Session->write('Registration.Registration.modified', date('Y-m-d H:i:s'));
		} else {
			// Make and set a booking number to Session
			$this->Session->write('Registration.Registration.number' , $this->Registration->generateUniqueNumber());			
		}
		
		$registration= $this->Session->read('Registration.Registration');
		$this->saveModelDataToSession($this,$registration);
		$this->updateStepStateToPrevious($this->params['controller'], $action);
		$this->finalize();
		$this->requestAction('steps/redirectToNextUnfinishedStep');
		
	}
	
	/**
	 * Finalizes the registration, saving it and emailing it to the registrator
	 */
	private function finalize() {
		$registration = $this->Session->read('Registration');
		$event = $this->Session->read('Event');
		
		// if we're in edit, we delete everything and save the session again
		if ($this->Session->check('loggedIn')){
			$this->Registration->deleteAll(array ('Registration.id' => $registration['Registration']['id'] ));						
			$this->Registration->Person->deleteAll(array ('Person.registration_id' => $registration['Registration']['id'] ));						
			$this->Registration->Registrator->deleteAll(array ('Registrator.registration_id' => $registration['Registration']['id'] ));								
		}
		if(!$this->Registration->saveAll($registration)) {
			$this->Session->del('Registrations');
			$this->Session->del('logedIn');
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
		} else {
			$this->Session->write('Event.registrationId', $this->Registration->id);
			$this->sendRegistrationConfirmMail($event, $registration['Registrator']);
			$this->Session->del('Registrations');
			$this->Session->del('logedIn');
			}
			
	}
	
	/*
	 * Inits the review mode
	 */
	function review(){
		$this->layout='registration';
		
		//as soon as we're on the review step we set it to previous so that that the user can go back to review mode by clicking the rocket

		$this->updateStepStateToPrevious($this->params['controller'], $this->params['action'] );	
		//you can't be in review if you haven't finished previous steps
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}		
	}
		
	/*
	 * Inits the receipt view for the whole registration
	 */
	function receipt() {
		$this->layout='registration';
		debug($this->Registration->validationErrors);
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
			$number = strtoupper($number);
			// Get an array from the database with all the info on the registration
			if($registration = $this->Registration->findByNumber($number)){
				$event = $registration['Event'];
				unset($registration['Event']);
				$this->Session->write('Event', $event);
				// Checks the array from the database and tries to match the email with the form
				if($registration['Registrator']['email'] == $email){
					
					$this->Session->write('loggedIn', true);
					
					// Retype email is not stored in the database, so we add it to the array
					$registration['Registrator']['retype_email'] = $registration['Registrator']['email'];
					
					$this->Session->write('Registration', $registration);
					$this->Session->write('Event.steps', $this->Registration->Event->Step->getInitializedSteps($registration['Registration']['event_id']));
					$this->setPreviousStepsToPrevious('Registrations','review');
					$this->requestAction('steps/redirectToNextUnfinishedStep');
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
	 * Sending a comfirmmail using the reciept view for layout
	 * @param unknown_type $registrator --session array for the registration module 
	 * @param unknown_type $registration -- session array for the registration module
	 */
	private function sendRegistrationConfirmMail($event,$registrator){
		if($this->Session->read('dontSendEmails')) return;
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
	
	/**
	 * Clear the session from data regarding Registration   
	 * TODO remove at deploy
	 */
	function clearSession() {
		if(Configure::read('debug') >= 1) {
			$this->Session->del('Registration');
			$this->Session->del('Event');
			$this->Session->del('loggedIn');
			$this->Session->setFlash('Session rensad');
		} else {
			$this->Session->setFlash('You can\'t use debug functions when not in debug mode.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
	}
	
	function clearSessionAndRedirectToEvents() {
		$this->clearSession();
		$this->redirect(array('controller' => 'events', 'action' => 'index'));
	}
	
	function toggleSendEmails() {
		if(Configure::read('debug') >= 1) {
			if($this->Session->read('dontSendEmails')) {
				$this->Session->setFlash('Will send emails again.');
				$this->Session->write('dontSendEmails', 0);
			} else {
				$this->Session->setFlash('Wont send email anymore.');
				$this->Session->write('dontSendEmails', 1);
			}
		} else {
			$this->Session->setFlash('You can\'t use debug functions when not in debug mode.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
	}
	
	
	/*
	 * Debug function that populates Session with dummy data and redirects to next unfinished step
	 * TODO delete on deploy!
	 */
	function populateSessionAndRedirectToNextUnfinished() {
		
		$debugSession = array(
			'Registration' 	=> 	array(
								'event_id' => 7
			),
			'Person' => array(
						'0' => 	array(
								'first_name' => 'Andreas',
								'last_name'  => 'Fliesberg',
								'role_id' => 14
						),
						'1' => array(
								'first_name' => 'Tim',
								'last_name'  => 'Olsson',
								'role_id' => 17
						),
						'2' => array(
								'first_name' => 'Pelle',
								'last_name'  => 'Skarsgård',
								'role_id' => 17
						)
			),
			'Registrator' => array(
							 'first_name' => 'Andreas',
							 'last_name' => 'Fliesberg',
							 'email' => 'andreas_fliesberg@hotmail.com',
							 'retype_email' => 'andreas_fliesberg@hotmail.com',
							 'phone' => '070-123456789',
							 'c_o' => '',
							 'street_address' => 'Wollmar Yxkullsgatan 28',
							 'postal_code' => '121 83',
							 'city' => 'Stockholm',
							 'extra_information' => 'Tim Olsson i mitt sällskap är allergisk mot spiskummin'
			)
		);
		
		$this->Session->write('Registration', $debugSession);
		
		$this->updateStepStateToPrevious('People', 'create');
		$this->updateStepStateToPrevious('Registrators', 'create');
		
		$this->requestAction('steps/redirectToNextUnfinishedStep');
	}
}


