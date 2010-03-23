<?php

class PeopleController extends AppController {
	var $helpers = array('Html','Form','Javascript');

	function index(){

	}

	function create($amountOfPeople = 1){

		$this->set('amountOfPeople' , $amountOfPeople);

		$this->set('event' , $this->Person->Registration->Event->findById($event =1));
			
		$this->set('roles',$this->Person->Role->find('list'));
		
		$roles = $this->Person->Role->find('list');
	}

	function add(){
		if($this->data['amount']){
			$this->redirect(array('action'=>'create',$this->data['amount']));
		}
		
		if($this->data['Person']){
			$this->Session->write('errors', $this->Person->validatesMultiple($this->data));
		}
		
		$this->redirect(array('action' => 'create'));
		
	}
}