<?php
App::import('Sanitize');

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html');
	
	function index() {
		
		$this->set('events', $this->Registration->Event->find('all'));
	}
	
	function create($id) {
		$this->set("event_id", $id);
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name'))));
		
		if(!empty($this->data)) {
			// Passes the data through the Sanitize clean filter and saves the registration
			if($this->Registration->save(Sanitize::clean($this->data))) {
				//save successful TODO user needs feedback here
				$this->Session->setFlash("Tack för din anmälan, {$this->data['Registration']['first_name']}.");
				$this->redirect(array('action' => 'confirm'));
			}
		}
	}
	
	function confirm() {
		
	}
	
}