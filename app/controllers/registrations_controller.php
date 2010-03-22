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
	function create($eventId = null) {
		
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
		
	}
	
	/**
	 * Just to save the data from create action
	 */
	function add() {

		$saveStatus = $this->Registration->saveAndReturnStatus($this->data);
		
		$this->Session->setFlash($saveStatus['flash']);
		$this->Session->write('errors', $this->Registration->validationErrors);
		
		switch ($saveStatus['type']) {
			case 2:
				//success
				$this->redirect(array('action' => 'create', $saveStatus['event_id']));
				break;
			case 4:
				//failure
				$this->redirect(array('action' => 'create', $saveStatus['event_id']));
				break;
			case 400:
				//bad request
				$this->redirect(array('action' => 'index'));
				break;
			default:
				$this->redirect(array('action' => 'index'));
				break;
		}
	}
	
	function choose_people() {
		
	}
}