<?php
class RegistrationsController extends AppController {
	
	var $helpers = array('Form', 'Html');
	
	function index() {
		
		$this->set('events', $this->Registration->Event->find('all'));
	}
	
	function create($id) {
		$this->set("event_id", $id);
		if(!empty($this->data)) {
			if($this->Registration->save($this->data)) {
				//save successful TODO user needs feedback here
				$this->Session->setFlash("Tack för din anmälan, {$this->data['Registration']['first_name']}.");
				$this->redirect(array('action' => 'confirm'));
			}
		}
	}
	
	function confirm() {
		
	}
	
	
	
}