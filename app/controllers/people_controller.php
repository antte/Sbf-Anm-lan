<?php

class PeopleController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	function index() {
		$this->redirect(array('controller' => 'events'));
	}
	
	function create($amountOfPeople = NULL,  $people = NULL, $events = NULL){
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
		
		$this->loadModel("Event");
		$this->set('event' , $this->Event->find('list' , array('fields' => array('Event.name.'))));
				
				
	}
	
	function add() {

		$saveStatus = $this->Person->saveAndReturnStatus($this->data);
		
		$this->Session->setFlash($saveStatus['flash']);
		$this->Session->write('errors', $this->Person->validationErrors);
		
		switch ($saveStatus['type']) {
			case 2:
				//success
				$this->redirect(array('action' => 'create', $saveStatus['reservation_id']));
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
	
}