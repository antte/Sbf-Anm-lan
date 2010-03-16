<?php
App::import('Sanitize');

class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Javascript');
	
	var $validate = array(
        'email' => 'email'
    );
	
	function index() {
		
		$this->set('events', $this->Registration->Event->find('all'));
	}
	
	function create($id = null) {
		
		if (!$id) $this->redirect(array('action' => 'index'));
		
		$this->set("event_id", $id);
		
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array
		
		if(!empty($this->data)) {
			if($this->Registration->save(Sanitize::clean($this->data))) { // Passes the data through the Sanitize clean filter and saves the registration
				// registration data saved successfully
				$this->Session->setFlash("Tack för din anmälan, {$this->data['Registration']['first_name']}.");
				$this->redirect(array('action' => 'confirm'));
			}
		}
	}
	
	/**
	 * When a registration is saved this view will be called and a feedback message shown
	 */
	function confirm() {
		
	}
	
}