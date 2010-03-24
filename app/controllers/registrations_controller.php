<?php

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	function index() {
		$this->redirect(array('controller' => 'events'));
	}
	/**
	 * Creates a registration to an event
	 * @param $event_id Id of an event for which the registration is created.
	 */
	function create() {
		$eventId = $this->Session->read('eventId');
		
		//can't create registration without event
		if (!$eventId) $this->redirect(array('action' => 'index'));
		
		//if we get any validation errors, errors will cointain them
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors', null);
		
		$this->set("event_id", $eventId);
		
		$this->loadModel('Event');
		$this->set("eventName", $this->Event->field('name', array('id' => $eventId)));
		
		$this->loadModel('Event');
		$this->set("eventName", $this->Event->field('name', array('id' => $eventId)));
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
		
		$this->set('sessionApa' , $this->Session->read());
	
	}
	
	/**
	 * Just to save the data from create action
	 */
	function add() {		
		if(empty($this->validationErrors)) {
			//if we dont have errors all was successful and we continue with the registration
			$this->pushToSessionArray('Registration', $this->data);
			$this->redirect(array('action'=>'finalize'));			
		} else {
			$this->Session->write('errors', $this->validationErrors);
			$this->redirect(array('action' => 'create'));
		}
		
	}
	
	/**
	 * Finalizes the registration (saving it)
	 */
	function finalize() {
		$saveStatus = $this->Registration->saveAndReturnStatus($this->Session->read('Registration'));
		
	}
	
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create'));
	}
	
}
