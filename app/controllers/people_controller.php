<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	function index(){
		
	}
	/**
	 * Controlles the amount of person input fields rows
	 * @param unknown_type $amountOfPeople
	 */
	function create($amountOfPeople = 1){
		
		if (!$this->Session->read('Registration.Registration.event_id')) $this->redirect(array('controller' => 'events', 'action' => 'index'));
		
		//people/create/in_review_mode:1
		if(isset($this->params['named']['in_review_mode'])) {
			if($this->params['named']['in_review_mode']) {
				$this->set('in_review_mode', true);
				$this->set('people', $this->Session->read('Registration.Person'));
			}
		}
	
		if (!is_numeric($amountOfPeople) || $amountOfPeople < 1) {
			$this->Session->setFlash('Skriv hur många personer du vill anmäla. Du måste anmäla minst en person.');
			$this->redirect(array('action' => 'create'));
		}
		
		$this->set('amountOfPeople' , Sanitize::clean($amountOfPeople));
		$event = $this->Person->Registration->Event->find('first', array('conditions' => array('id' => $this->Session->read('eventId')), 'fields' => array('Event.id', 'Event.name')));
		$this->set('event' , $event['Event']);
		$this->set('roles',$this->Person->Role->find('list'));
		$this->set('errors', $this->Session->read('errors'));
	}

	/**
	 * 
	 * Controling the data from views and if valid redirekt to next step other redirekt to previous view  
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
				$this->saveModelDataToSession('Person', Sanitize::clean($this->data));
				if( isset($this->data['Person']['in_review_mode']) && $this->data['Person']['in_review_mode'] ) {
					//we dont want that hidden input in_review_mode to be in our session
					$this->Session->del('Registration.Person.in_review_mode');
					$this->redirect(array('controller' => 'registrations', 'action'=>'review'));	
				} else {
					$this->redirect(array('controller' => 'registrators', 'action'=>'create'));
				}
			} else {
				$this->Session->write('errors', $errors);
				$this->redirect(array('action' => 'create', sizeof($this->data['Person'])));
			}
		}
	}
	
	/**
	 * Fetch and return data from in acociate with this controler for use in elements
	 * return $registrator array of people connected to the registration
	 */
	function receipt(){
		$registrationData = $this->Person->Registration->findById($this->Session->read('registrationId'));
		$people = $registrationData['Person'];
		foreach ($people as &$person){
			$person['role_name'] = $this->Person->Role->field('name',array ('id'=> $person['role_id'] )); 
		}
		return $people;
	}
	
	function edit() {
		$people = $this->Session->read('Registration.Person');
		$this->set('amountOfPeople' , $this->Session->read(''));
		debug($people);
	}
	
	function review() {
		if (isset($this->params['requested'])) {
			$people = $this->Session->read('Registration.Person');
			foreach ($people as &$person){
				$person['role_name'] = $this->Person->Role->field('name',array ('id'=> $person['role_id'] )); 
			}
			return $people;
		}
	}
}