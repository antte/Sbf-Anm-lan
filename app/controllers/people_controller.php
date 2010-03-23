<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	function index(){

	}

	function create($amountOfPeople = 1){

		$this->set('amountOfPeople' , $amountOfPeople);

		$this->set('event' , $this->Person->Registration->Event->findById($event =1));
			
		$this->set('roles',$this->Person->Role->find('list'));

		$this->set('errors', $this->Session->read('errors'));
	}

	function add(){
		if(isset($this->data['amount'])){
			$this->redirect(array('action'=>'create',$this->data['amount']));
		}
		
		if($this->data['Person']){
			$errors = $this->Person->validatesMultiple($this->data);
			if(empty($errors)) {
				//if we dont have errors all was successful and we continue with the registration
				$this->pushToSessionArray('Registration', $this->data);
				$this->redirect(array('controller' => 'registrations', 'action'=>'create', $this->Session->read('eventId')));			
			} else {
				$this->Session->write('errors', $errors);
				$this->redirect(array('action' => 'create'));
			}
		}
		
	}
	
	
	
}