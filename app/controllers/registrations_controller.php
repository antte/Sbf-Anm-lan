<?php
App::import('Sanitize');

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	var $validate = array(
        'email' => 'email' /*TODO does this work?*/
    );
	
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
		if (!empty($this->data)) $this->set('data', $this->data);
		if(!empty($this->data)) {
			if($this->Registration->save($this->data)) { // Passes the data through the Sanitize clean filter and saves the registration
				// registration data saved successfully
				$this->Session->setFlash("Tack för din anmälan, {$this->data['Registrator']['first_name']}.");
				
			}
		}
	}
	
}