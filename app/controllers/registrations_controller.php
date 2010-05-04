<?php

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript', 'Number');
	
	var $components = array('Email');
	var $altName = 'Bokningar';
	var $altDescribe = 'Det som en registration gör';
	
	
	function index() {
		if (isset($this->params['requested'])) return $this->getRegistration();
		
		//Link to index and this will take you to the right step.
		$this->requestAction('steps/redirectToNextUnfinishedStep');
	}
	
	/**
	 * Saves Registration.Registration To Session and saves and emails the registration
	 * @param unknown_type $action
	 */
	function add($action = null){
		// If there already exists a booking number the user is editing an existing registration
		if ($this->Session->check('Registration.Registration.number')){
			
			/**
			 * If this registration is being edited by an admin we dont want modified to be
			 * updated because it isnt the registrator that is updating it.
			 */

			if (!$this->requestAction('admins/checkAdminLoggedIn')) {
				// Set the modified date for the editation and leave registration number unchanged
				$this->Session->write('Registration.Registration.modified', date('Y-m-d H:i:s'));
			}
			
		} else {
			// Make and set a booking number to Session
			$this->Session->write('Registration.Registration.number' , $this->Registration->generateUniqueNumber());			
		}
		
		$registrationRegistration = $this->Session->read('Registration.Registration');
		$this->saveModelDataToSession($this,$registrationRegistration);
		$this->updateStepStateToPrevious($this->params['controller'], $action);
		
		//Here we get Registration from session so we can run saveAll on it
		$registration = $this->Session->read('Registration');
		
		$registration = $this->Registration->Invoice->addInvoiceToRegistration($registration);
		
		if($this->requestAction('admins/checkAdminLoggedIn')) $registration = $this->touchByAdmin($registration);
		
		if ($this->Session->check('loggedIn') || $this->requestAction('admins/checkAdminLoggedIn')){
			// if we're in edit, we delete everything and save the session again because updateAll & deleteAll are ... unkind
			$this->Registration->deleteAllRegistrationRelatedDataById($registration['Registration']['id']);
		}
		
		if($this->Registration->saveAll($registration)) {
			$this->Session->write('Event.registrationId', $this->Registration->id);
			
			if( !($this->data['Registration']['sendConfirmationEmail'] == 0) ) {
				
				//If we have a message for the registrator we want to put it in session so that the email element can send it along
				$this->Session->write('Registration.messageForRegistrator', $this->data['Registration']['message_for_registrator']);
				
				//We send out confirmation mail unless an admin has explicitly chosen not to
				$this->sendRegistrationConfirmMail($this->Session->read('Event'), $registration['Registrator']);
			}
			
			$this->clearSessionFromAllRegistrationInformation();
		} else {
			$this->clearSessionFromAllRegistrationInformation();
			$this->Session->setFlash('Vi ber om ursäkt, din registrering kunde inte slutföras. Kontakta support.');
		}
		
		//If you're an admin you dont want to get to receipt when you're done saving a registration
		if($this->requestAction('admins/checkAdminLoggedIn')) $this->redirect(array('controller' => 'admins', 'action' => 'eventindex'));
		
		$this->redirect(array('action' => 'receipt'));
		
	}
	
	/*
	 * 
	 */
	function review(){
		$this->layout='registration';
				
		//you can't be in review if you haven't finished previous steps
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}
		
		$sum = $this->Registration->Invoice->calculatePrice($this->Session->read('Event.price_per_person'), sizeof($this->Session->read('Registration.Person')));
		$this->set('sum', $sum);
		
		if ($this->Session->check('adminLoggedIn'))
			$this->set('submitLabel' , 'Spara');	
		else 
			$this->set('submitLabel' , 'Bekräfta anmälan');
		
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
	
	function login() {
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors', null);
		
	}
	
	/*
	 * Recieve and process login credentials, fetches and stores the registration to session and redirects to review
	 */
	function addLogin(){
		if(!$this->data['Registration']['number'] && !$this->data['Registrator']['email']) {
			// First time visiting the site, do nothing and just display the view
			$this->Session->write('errors.noInput', 'Fyll i <strong>bokningsnummer</strong> och <strong>email</strong>');
		} else { 
			// Sanitize the input data
			if($this->data['Registration']['number']) {
				$number = Sanitize::clean($this->data['Registration']['number']);
			} else {
				$this->Session->write('errors.noNumber', 'Du har glömt fylla i <strong>bokningsnummer</strong>');
				$number = false;
			}
			if ($this->data['Registrator']['email']){
				$email = Sanitize::clean($this->data['Registrator']['email']);
			} else {
				$this->Session->write('errors.noEmail', 'Du har glömt fylla i <strong>email</strong>');
				$email = false;
			}
			if ($number && $email){
				$number = strtoupper($number);
				// Get an array from the database with all the info on the registration
				if($registration = $this->Registration->findByNumber($number)){
					$event = $registration['Event'];
					unset($registration['Event']);
					unset($registration['Invoice']);
					$this->Session->write('Event', $event);
					// Checks the array from the database and tries to match the email with the form//
					$email = $this->data['Registrator']['email'];
					if($registration['Registrator']['email'] == $email){
						
						$this->Session->write('loggedIn', true);
						$this->Registration->putRegistrationInSession($registration, $this->Session);
						$this->setPreviousStepsToPrevious('Registrations','review');
						$this->requestAction('steps/redirectToNextUnfinishedStep');
					} else {
						//the user has put in wrong values in the field 'email'
						$this->Session->write('errors.unvalidEmail', 'Är du säker på att skrev rätt <strong>email?</strong>');
					} 
				} else {
					//the user has put in wrong values in at least the 'booking number' field
					$this->Session->write('errors.noBookingnr', 'Är du säker på att du skrev rätt <strong>bokningsnummer?</strong>');		
				}
			}
		}
		$this->redirect(array('controller' => 'registrations', 'action' => 'login'));		
	}
	
	/**
	 * Sending a comfirmmail using the reciept view for layout
	 * @param unknown_type $registrator --session array for the registration module 
	 * @param unknown_type $registration -- session array for the registration module
	 */
	private function sendRegistrationConfirmMail($event,$registrator){
		if($this->Session->read('dontSendEmails')) return;
	 		$mailArray['first_name'] = $registrator['first_name'];
			$mailArray['last_name'] = $registrator['last_name'];
			$mailArray['email'] = $registrator['email'];
			$mailArray['event_name'] = $event['name'];
	 		$this->sendBookingMail($mailArray);
			}
	
	function resendConfirmMail($registrationNumber) {
		if(isset($this->params['requested']))
	 	$registrationNumber = Sanitize::clean($registrationNumber);
		$registration = $this->Registration->findByNumber($registrationNumber);
		$mailArray['first_name'] = $registration['Registrator']['first_name'];
		$mailArray['last_name'] = $registration['Registrator']['last_name'];
		$mailArray['email'] = $registration['Registrator']['email'];
		$mailArray['event_name'] = $registration['Event']['name'];
		$this->sendBookingMail($mailArray);
			}
	
	function sendBookingMail($mailArray){
   	    
		$this->Email->smtpOptions = array(
			'port'			=> '25', 
			'timeout'		=> '30',
			'host' 			=> 'localhost'
		);
		
		$this->Email->delivery 	= 'smtp';
		
		$this->Email->from		= 'noreply@sbf.se';
		$this->Email->to		= "{$mailArray['first_name']} {$mailArray['last_name']} <{$mailArray['email']}>";
		$this->Email->bcc		= "it sbf <it@sbf.se>";
		$this->Email->replyTo	= 'it@sbf.se';
		$this->Email->subject	= "Kvitto för din anmälan till {$mailArray['event_name']}";
		$this->Email->template	= 'default';
		$this->Email->sendAs	= 'both'; //both text and html
		$this->Email->send();
		
	
	}
	
	/**
	 * if a registration has been made recently we return it
	 * we need to take into account that this action can be requested both before and after a registration has been saved
	 */
	private function getRegistration() {
		// In receipt mode, we still have SOME data in session but not everything we need!
		
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
	 */
	function clearSession() {
		if(Configure::read('debug') >= 1) {
			$this->Session->del('Registration');
			$this->Session->del('Event');
			$this->Session->del('errors');
			$this->Session->del('adminLoggedIn');
			$this->Session->del('loggedIn');
			$this->Session->setFlash('Session rensad');
		} else {
			$this->Session->setFlash('You can\'t use debug functions when not in debug mode.');
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
	}
	
	private function clearSessionFromAllRegistrationInformation() {
		$this->Session->del('Registration');
		$this->Session->del('loggedIn');
	}
	
	function clearSessionAndRedirectToEvents() {
		$this->clearSession();
		$this->redirect(array('controller' => 'events', 'action' => 'index'));
	}
	
	function toggleSendEmails($controller, $action) {
			if($this->Session->read('dontSendEmails')) {
				$this->Session->setFlash('Will send emails again.');
				$this->Session->write('dontSendEmails', 0);
			} else {
				$this->Session->setFlash('Wont send email anymore.');
				$this->Session->write('dontSendEmails', 1);
			}
			$this->redirect( array('controller' => $controller, 'action' => $action) );
	}
	
	function debugToggleSendEmails($controller, $action){
		if(Configure::read('debug') >= 1) {
			$this->toggleSendEmails($controller, $action);
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
	
	/**
	 * 
	 */
	function sendEmails() {
		if ($this->Session->read('dontSendEmails')) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * Makes the current admin touch a registration (updating its modified and modified by values)
	 */
	private function touchByAdmin($registration) {
		
		$registration['Registration']['modified_admin'] 	= date('Y-m-d H:i:s');
		$registration['Registration']['modified_admin_id']	= $this->requestAction("admins/getCurrentAdminId");
		
		return $registration;
		
	}
	
	function getMessageForRegistrator(){
		if (!isset($this->params['requested'])) return;
		
		if ($this->Session->check('Registration.messageForRegistrator')){
			return $this->Session->read('Registration.messageForRegistrator');
		} else {
			return false;
		}
	}

	function deleteRegistrationAndRedirect($registrationNumber){
		$registrationId = $this->Registration->field('id',array ('number' => $registrationNumber));
		$this->Registration->deleteAllRegistrationRelatedDataById($registrationId);
		$this->Session->setFlash('<h4 class="login_info grid_12"> Registrationen '. $registrationNumber. ' är borttagen </h4>');
		$this->redirect(array('controller' => 'admins' , 'action' => 'eventindex'));
	}

}


