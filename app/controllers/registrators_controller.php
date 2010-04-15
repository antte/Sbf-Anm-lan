<?php

class RegistratorsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	function index() {
		$this->redirect(array('controller' => 'events'));
	}
	
	/**
	 * Inits the create view and sets the first person in the party to be the default registrator
	 */
	function create() {
		//change to registration layout so that the rocket will be present on all steps.
		$this->layout = 'registration';
		
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}	
		
		//Can't create registration without event
		$eventId = $this->Session->read('Registration.Registration.event_id');
		if (!$eventId) $this->redirect(array('action' => 'index'));		
		
		//reads data from session in order to figure out if the user already has visited the module
		if($this->Session->read('Registration.Registrator')){
			$this->set('registrator', $this->Session->read('Registration.Registrator'));
		}

		$eventId = $this->Session->read('Registration.Registration.event_id');
				
		//can't create registration without event
		if (!$eventId) $this->redirect(array('action' => 'index'));

		//if the Module Person hav been finnished before this step set the first person names to view
		if ($this->Session->check('Registration.Person')){	
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
		} else {
			$this->set('first_name', "");
			$this->set('last_name', "");
			
		}
		
		//if we get any validation errors, errors will contain them
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors', null);
		
		$this->loadModel('Event');
		$this->set("eventName", $this->Event->field('name', array('id' => $eventId)));
		
		$this->loadModel("Role");
		$this	->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
	
	}
	
	/**
	 * Saves Contact Information and redirects to next step
	 */
	function add($action = null) {
		$this->Registrator->set($this->data); 
		if($this->Registrator->validates()) {
			$this->saveModelDataToSession($this);
			$this->updateStepStateToPrevious($this->params['controller'], $action);
			$this->requestAction('steps/redirectToNextUnfinishedStep');
		} else {
			$this->Session->write('errors', $this->Registrator->validationErrors);
			$this->redirect(array('action' => 'create'));
		}		
	}
	
	/*
	 * Fetches registration data from the database
	 * @return array Registrator data for the receipt
	 */
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
