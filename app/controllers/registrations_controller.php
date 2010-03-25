<?php

class RegistrationsController extends AppController {
	
	/**
	 * Finalizes the registration (saving it)
	 */
	function finalize() {
		/*
		$success = $this->Registration->saveAll($this->Session->read('Registration'));
		
		if ($success) {
			$this->Session->del('Registraion');
		} else {
			
		}*/
		
		$saveStatus = $this->Registration->saveAndReturnStatus($this->Session->read('Registration'));
		/*
		if($saveStatus['code'] == 2) {
			$this->Session->del('Registraion');
		}
		*/
	}
	
	function clearSession() {
		$this->Session->del('Registration');
		$this->Session->setFlash('Session rensad');
		$this->redirect(array ('action' => 'create'));
	}
	
	function receipt() {
		
	}
	
}
