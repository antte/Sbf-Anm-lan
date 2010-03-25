<?php

class RegistrationsController extends AppController {
	
	/**
	 * Finalizes the registration (saving it)
	 */
	function finalize() {
		$eventId['Registration']['event_id'] = $this->Session->read('eventId');
		$this->saveModelDataToSession('Registration', $eventId);
		$saveStatus = $this->Registration->saveAndReturnStatus($this->Session->read('Registration'));
	}
	
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create'));
	}
	
}