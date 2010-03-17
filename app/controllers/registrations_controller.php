<?php
App::import('Sanitize');

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	function index() {
		
		$this->set('events', $this->Registration->Event->find('all'));
	}
	
	/**
	 * Creates a registration to an event
	 * @param $event_id Id of an event for which the registration is created.
	 */
	function create($event_id = null) {
		
		if (!$event_id) $this->redirect(array('action' => 'index')); //can't create registration without event
		
		$this->set("event_id", $event_id);
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
		
	}
	
	/**
	 * Just to save the data from create action
	 */
	function add() {
		if(!empty($this->data)) {
			
			debug($this->data);
			
			//Before we save the date we check to see if a similar registration has already been registered
			$found = $this->Registration->find('first', array(
			'conditions' => array(
				'event_id' 		=> $this->data['Registration']['event_id'],
				'first_name' 	=> $this->data['Registration']['first_name'],
				'last_name' 	=> $this->data['Registration']['last_name'],
				'email' 		=> $this->data['Registration']['email']
			)));
			
			if (empty($found)) {
				if($this->Registration->save($this->data)) { // TODO Passes the data through the Sanitize clean filter and saves the registration
					// registration data saved successfully
					$this->Session->setFlash("Tack för din anmälan, {$this->data['Registration']['first_name']}.");
					
				} else {
					$this->Session->setFlash("Det blev fel.");
					$this->Session->write('errors', $this->Registration->validationErrors);
					if (!is_numeric($this->data['Registration']['event_id'])) { 
						//Normally the event_id should be present but a malicious user could omit or change it so we need to verify it
						$this->flash("Error", array('action' => 'index'));
					}
					$this->redirect(array('action' => 'create', $this->data['Registration']['event_id']));
					
				}
			} else {
				$this->Session->setFlash("Det verkar som att du redan är anmäld.");
			}
		}
	}
	
}