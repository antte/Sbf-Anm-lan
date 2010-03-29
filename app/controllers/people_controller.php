<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	function index(){
		
	}

	function create($amountOfPeople = 1){
		//debug($this->Session->read());
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
				$this->redirect(array('controller' => 'registrators', 'action'=>'create', $this->Session->read('eventId')));			
			} else {
				$this->Session->write('errors', $errors);
				$this->redirect(array('action' => 'create', sizeof($this->data['Person'])));
			}
		}
	}
	
	function receipt(){
		$people = $this->Session->read('Registration.Person');
		foreach ($people as &$person){
			$person['role_name'] = $this->Person->Role->field('name',array ('id'=> $person['role_id'] )); 
		}
//		debug($people);
		return $people;
	}
	
	function edit() {
		$people = $this->Session->read('Registration.Person');
		$this->set('amountOfPeople' , $this->Session->read(''));
		debug($people);
	}
}