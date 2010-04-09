<?php

class RegistratorsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	function index() {
		$this->redirect(array('controller' => 'events'));
	}
	
	/**
	 * Creates a registration to an event
	 * @param $event_id Id of an event for which the registration is created.
	 */
	function create() {
		//change to registration layout so that the rocket will be precent on all steps.
		echo $this->layout = 'registration';
		
		if (!$this->previousStepsHasData($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}	
		
		
		//Can't create registration without event
		debug('Registration');
		$eventId = $this->Session->read('Registration.Registration.event_id');
		if (!$eventId) $this->redirect(array('action' => 'index'));
		
		//If you haven't finished people(sällskap) module you shouldn't be here
		$person = $this->Session->read('Registration.Person');
		if(empty($person)) {
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
		
		
		//$this->set('registration', $this->Session->read('Registration'));
		//people/create/in_review_mode:1
		
		//reads data from session in order to figure out if the user already has visited the module
		if($this->Session->read('Registration.Registrator')){
			$this->set('registrator', $this->Session->read('Registration.Registrator'));
		}
		
		
		
		/*
		if(isset($this->params['named']['in_review_mode']) && $this->params['named']['in_review_mode']) {
			$this->set('in_review_mode', true);
		} else {
			$this->set('in_review_mode', false);
		}
		*/
		

		//debug($this->Session->read());
		$eventId = $this->Session->read('Registration.Registration.event_id');
				
		//can't create registration without event
		if (!$eventId) $this->redirect(array('action' => 'index'));

		
		//get person from session to set the name by default to the first person from the people form
		$first_person = $this->Session->read('Registration.Person');
		
		foreach($first_person as $person) {
			//
			$first_name = $person['first_name'];
			$last_name = $person['last_name'];
			break;
		}
		$this->set('first_name', $first_name);
		$this->set('last_name', $last_name);
		
		
		//if we get any validation errors, errors will contain them
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors', null);
		
		$this->loadModel('Event');
		$this->set("eventName", $this->Event->field('name', array('id' => $eventId)));
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
	
	}
	
	/**
	 * Just to save the data from create action
	 */
	function add() {
				
		$this->Registrator->set($this->data); 
		if($this->Registrator->validates()) {
				$this->finalizeStep($this);				
				$this->requestAction('steps/redirectToNextUnfinishedStep');	
		} else {
			$this->Session->write('errors', $this->Registrator->validationErrors);
			$this->redirect(array('action' => 'create'));
		}
		
	}

 function receipt(){	 	
		if (isset($this->params['requested'])) {
			$registrationData = $this->Registrator->Registration->findById($this->Session->read('registrationId'));
			return $registrationData['Registrator'];
		}
	}
	
/*	TODO deprecated? find out if this function is depricated.
 * 	function review() {
		if (isset($this->params['requested'])) {
			return $this->Session->read('Registration.Registrator');
		}
	}
	*/
}
