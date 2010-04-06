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
		$this->set('registration', $this->Session->read('Registration'));
		//people/create/in_review_mode:1
		if(isset($this->params['named']['in_review_mode']) && $this->params['named']['in_review_mode']) {
			$this->set('in_review_mode', true);
			$this->set('registrator', $this->Session->read('Registration.Registrator'));
		}
		
	//debug($this->Session->read());
		$eventId = $this->Session->read('Registration.Registration.event_id');
				
		//can't create registration without event
		if (!$eventId) $this->redirect(array('action' => 'index'));
		
		//if we get any validation errors, errors will cointain them
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
			//if we dont have errors all was successful and we continue with the registration
			
			$this->saveModelDataToSession('Registrator', Sanitize::clean($this->data));
			$steps = $this->Session->read('Registration.Event.steps');
			foreach($steps as &$step) {
				$step['current_step'] = false;
			}
			$steps['Review']['current_step'] = true;
			$this->Session->write('Registration.Event.steps', $steps);
			if( isset($this->params['named']['in_review_mode']) ) {
				$this->redirect(array('controller' => 'registrations', 'action'=>'review'));	
			} else {
				//redirect to next step
				$this->redirect(array('controller' => 'registrations', 'action' => 'review'));
			}
		} else {
			$this->Session->write('errors', $this->Registrator->validationErrors);
			
			//varför gör vi det här: (?)
			$this->Set('errors', $this->Registrator->validationErrors);
			
			$this->redirect(array('action' => 'create'));
		}
		
	}

	function receipt(){	 	
		if (isset($this->params['requested'])) {
			$registrationData = $this->Registrator->Registration->findById($this->Session->read('registrationId'));
			return $registrationData['Registrator'];
		}
	}
	
	function review() {
		if (isset($this->params['requested'])) {
			return $this->Session->read('Registration.Registrator');
		}
	}
}
