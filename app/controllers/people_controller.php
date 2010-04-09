<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	/**
	 * Controlles the amount of person input fields rows
	 * @param unknown_type $amountOfPeople
	 */
	function create($amountOfPeople = 1){
		$this->layout='registration';
		if (!$this->previousStepsHasData($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}	
		if (!$this->Session->read('Registration.Registration.event_id')) $this->redirect(array('controller' => 'events', 'action' => 'index'));
		
		//reads data from session in order to figure out if the user already has visited the module
		if($this->Session->read('Registration.Person')){
			$this->set('people', $this->Session->read('Registration.Person'));
		}
	
		if (!is_numeric($amountOfPeople) || $amountOfPeople < 1) {
			$this->Session->setFlash('Skriv hur många personer du vill anmäla. Du måste anmäla minst en person.');
			$this->redirect(array('action' => 'create'));
		}
		

		$this->set('amountOfPeople' , Sanitize::clean($amountOfPeople));
		$event = $this->Person->Registration->Event->find('first', array('conditions' => array('id' => $this->Session->read('eventId')), 'fields' => array('Event.id', 'Event.name')));
		$eventId = $this->Session->read('Registration.Registration.event_id');
		$this->set('eventName' , $this->Person->Registration->Event->field('name', array('id' => $eventId)));
		
		$this->set('roles',$this->Person->Role->find('list'));
		$this->set('errors', $this->Session->read('errors'));
	}

	/**
	 * Controling the data from views and if valid redirect to next step other redirect to previous view  
	 */
	function add(){
		if(isset($this->data['Person']['amount'])){
			$this->Session->del('errors');
			$this->redirect(array('action'=>'create',$this->data['Person']['amount']));
		}
		
		if($this->data['Person']){
			$errors = $this->Person->validatesMultiple($this->data);
			
			if(empty($errors)) {
				//if we dont have errors all was successful and we continue with the registration
				
				// check if session is already set *before* saving the form, to check if we're in edit mode
				// TODO is this deprecated?
				if($this->Session->read('Registration.Person')){
					$edit_mode = true;
				}
				$this->finalizeStep($this);				
				$this->requestAction('steps/redirectToNextUnfinishedStep');
				
			} else {
				$this->Session->write('errors', $errors);
				$this->redirect(array('action' => 'create', sizeof($this->data['Person'])));
			}
		}
	}
}	
