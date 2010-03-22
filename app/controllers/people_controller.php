<?php

class PeopleController extends AppController {

	var $helpers = array('Form', 'Html', 'Javascript');

	function index() {
		$this->redirect(array('controller' => 'events'));
	}

	function create($amountOfPeople = NULL,  $people = NULL, $events = NULL){
		$this->loadModel("Role");
		$this->set('roles', $this->Role->find('list', array('fields' => array('Role.name')))); //Find list fetches roles as an assoc array

		$this->loadModel("Event");
		$this->set('event' , $this->Event->find('list' , array('fields' => array('Event.name.'))));


	}

	function add() {

		$saveStatus = $this->Person->cleanSave($this->data);
			

	}

}