<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	/**
	 * Controlles the amount of person input fields rows
	 * @param unknown_type $amountOfPeople
	 */
	function create($amountOfPeople = 1){
		$this->layout='registration';		
		debug($this->Session->read('Registration'));	
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
				if($this->Session->read('Registration.Person')){
					$edit_mode = true;
				}
				$this->saveModelDataToSession('Person', Sanitize::clean($this->data));
				$steps = $this->Session->read('Event.steps');
					foreach($steps as &$step) {
						$step['current_step'] = false;
					}
				if( isset($edit_mode) ){ 
					//in review mode continue to review page
					$steps['Review']['current_step'] = true;
					$this->Session->write('Event.steps', $steps);
					$this->redirect(array('controller' => 'registrations', 'action'=>'review'));	
				} else {
					$steps['Registrator']['current_step'] = true;
					$this->Session->write('Event.steps', $steps);
					$this->redirect(array('controller' => 'registrators', 'action'=>'create'));
				}
			} else {
				$this->Session->write('errors', $errors);
				$this->redirect(array('action' => 'create', sizeof($this->data['Person'])));
			}
		}
	}
}	
