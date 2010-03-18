<?php

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	function index() {
		//TODO detta borde ju vara i events controllern
		$this->set('events', $this->Registration->Event->find('all'));
	}
	
	/**
	 * Creates a registration to an event
	 * @param $event_id Id of an event for which the registration is created.
	 */
	function create($event_id = null) {
		
		//can't create registration without event
		if (!$event_id) $this->redirect(array('action' => 'index'));
		
		//if we get any validation errors, errors will cointain them
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors', null);
		
		$this->set("event_id", $event_id);
		
		$this->loadModel('Event');
		$this->set("eventName", $this->Event->field('name', array('id' => $event_id)));
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
		
	}
	
	/**
	 * Just to save the data from create action
	 */
	function add() {
		
		$save_status = $this->Registration->save_and_return_status($this->data);
		
		$this->Session->setFlash($save_status['flash']);
		$this->Session->write('errors', $this->Registration->validationErrors);
		
		switch ($save_status['type']) {
			case 2:
				//success
				$this->redirect(array('action' => 'create', $save_status['event_id']));
				break;
			case 4:
				//failure
				$this->redirect(array('action' => 'create', $save_status['event_id']));
				break;
			case 400:
				$this->redirect(array('action' => 'index'));
				break;
			default:
				$this->redirect(array('action' => 'index'));
				break;
		}
	}
	
}