<?php
App::import('Sanitize');

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
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
		
	}
	
	/**
	 * Just to save the data from create action
	 */
	function add() {
		
		if(!empty($this->data)) {
			
			//Before we save the date we check to see if a similar registration has already been registered
			$found = $this->Registration->find('first', array(
			'conditions' => array(
				'event_id' 		=> $this->data['Registration']['event_id'],
				'first_name' 	=> $this->data['Registration']['first_name'],
				'last_name' 	=> $this->data['Registration']['last_name'],
				'email' 		=> $this->data['Registration']['email']
			)));
			
			if (empty($found)) {
				// Passes the data through the Sanitize clean filter and saves the registration
				if($this->Registration->save(Sanitize::clean($this->data))) { 
					// registration data saved successfully
					$firstName = Sanitize::clean($this->data['Registration']['first_name']);
					$this->Session->setFlash("Tack för din anmälan, $firstName.");
					
				} else {
					$this->Session->setFlash("Det blev fel.");
					$this->Session->write('errors', $this->Registration->validationErrors);
					if (!is_numeric($this->data['Registration']['event_id'])) { 
						//Normally the event_id should be present but a malicious user could omit or change it so we need to verify it
						$this->flash("Error", array('action' => 'index'));
					}
				}
			} else {
				$this->Session->setFlash("Det verkar som att du redan är anmäld.");
			}
			
			$this->redirect(array('action' => 'create', $this->data['Registration']['event_id']));
		
		} else {
			$this->Session->setFlash("Hur tycker du själv att det går?.");
			$this->redirect(array('controller' => 'events', 'action' => 'index'));
		}
	}
	
}