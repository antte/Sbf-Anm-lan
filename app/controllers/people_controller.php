<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	/**
	 * Inits the view for adding people (including amount of people) to the party
	 * @param unknown_type $amountOfPeople
	 */
	function create(){
		$this->layout='registration';
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');	
		}
		
		
		if (!$this->Session->read('Registration.Registration.event_id')) $this->redirect(array('controller' => 'events', 'action' => 'index'));
		
		// Checks if people are already in the session and sends an array to init edit mode in the view
		if($this->Session->check('Registration.Person')){
			$this->set('people', $this->Session->read('Registration.Person'));
			debug($this->Session->read());
			
			// Finds the size of the stored Session People array and sets the amountOfPeople
			$amountOfPeople = sizeof($this->Session->read('Registration.Person'));
		}
		
		
		// Fetches data from the database from event and roles
		$eventId = $this->Session->read('Registration.Registration.event_id');
		$this->set('eventName' , $this->Person->Registration->Event->field('name', array('id' => $eventId)));
		$this->set('roles',$this->Person->Role->find('list'));
		
		$this->set('errors', $this->Session->read('errors'));
		
		if(isset($this->data['Person']['amount'])){
			
			if(!isset($amountOfPeople)) {
				$amountOfPeople = $this->data['Person']['amount'];
			}
			
			// Checks if amountOfPeople is a validated number
			if (!is_numeric($amountOfPeople) || $amountOfPeople < 1) {
				$this->Session->setFlash('Skriv hur många personer du vill anmäla. Du måste anmäla minst en person.');
				$this->redirect(array('action' => 'create'));
			}
			
			$this->Session->del('errors');
			$this->set('amountOfPeople', Sanitize::clean($amountOfPeople));
		
		} 
		// amountOfPeople is set by Session, this is edit mode
		elseif(isset($amountOfPeople)) {
			$this->set('amountOfPeople', $amountOfPeople);	
			
		} 
		// if we've just loaded the page, set the default value to 1
		else {
			$this->set('amountOfPeople', 1);		
		}
		
	}
	
	/**
	* Saves People to Session and redirects to next unfinished step
	*/
	function add($amountOfPeople = 1){
		
		// Saves People in Session and redirects to next unfinished step
		if(isset($this->data['Person'])){
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
	
	/**
	 * Saves People and redirects to next step
	 * TODO TA BORT DEN HÄR, DEN GÖR INGET FINNS BARA KVAR PGA DOKUMENTATION AV TIDIGARE FUNGERANDE KOD
	 */
	function edit($action = null) {
		if(isset($this->data['Person']) && isset($action)){
			$errors = $this->Person->validatesMultiple($this->data);
			if(empty($errors)) {
				//$this->Session->del('Registration.Person');
				//$this->Session->write('Registration.Person', $this->data);
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
