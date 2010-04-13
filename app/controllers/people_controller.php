<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	/**
	 * Inits the view for adding people (including amount of people) to the party
	 * @param unknown_type $amountOfPeople
	 */
	function create($amountOfPeople = 1){
		$this->layout='registration';
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}
		if (!$this->Session->read('Registration.Registration.event_id')) $this->redirect(array('controller' => 'events', 'action' => 'index'));
		
		// Checks if people are already in the session and sends an array to init edit mode in the view
		if($this->Session->read('Registration.Person')){
			$this->set('people', $this->Session->read('Registration.Person'));
		}
		
		// Checks if amountOfPeople is a validated number
		if (!is_numeric($amountOfPeople) || $amountOfPeople < 1) {
			$this->Session->setFlash('Skriv hur många personer du vill anmäla. Du måste anmäla minst en person.');
			$this->redirect(array('action' => 'create'));
		}
		
		// Fetches data from the database from event and roles
		$this->set('amountOfPeople' , Sanitize::clean($amountOfPeople));
		$eventId = $this->Session->read('Registration.Registration.event_id');
		$this->set('eventName' , $this->Person->Registration->Event->field('name', array('id' => $eventId)));
		$this->set('roles',$this->Person->Role->find('list'));
		
		$this->set('errors', $this->Session->read('errors'));
	}
	
	/**
	* Change amount of people in your party
	*/
	function add(){
		if(isset($this->data['Person']['amount'])){
			$this->Session->del('errors');
			$this->redirect(array('action'=>'create',$this->data['Person']['amount']));
		} else {
			$this->redirect(array('action'=>'create'));			
		}
	}
	
	/**
	 * Saves People and redirects to next step
	 */
	function edit($action = null) {
		if(isset($this->data['Person']) && isset($action)){
			$errors = $this->Person->validatesMultiple($this->data);
			if(empty($errors)) {
				//if we dont have errors all was successful and we continue with the registration
				$this->saveModelDataToSession($this);
				$this->updateStepState($this->params['controller'], $action);
				$this->requestAction('steps/redirectToNextUnfinishedStep');
			} else {
				$this->Session->write('errors', $errors);
				$this->redirect(array('action' => 'create', sizeof($this->data['Person'])));
			}
		}
	}
	
}	
