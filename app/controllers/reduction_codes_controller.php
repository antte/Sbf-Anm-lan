<?php
App::import('Sanitize');
class ReductionCodesController extends AppController {
	
	var $helpers = array('html','form','javascript', 'number');
	
	var $altName = 'Rabatter';
	var $altDescribe = 'Hantera rabattkoder';
		
		/**
	 * Inits the view for adding people (including amount of people) to the party
	 * @param unknown_type $amountOfPeople
	 */
	function beforeFilter(){
		$this->layout='registration';	
	}
	
	/*
	 * Fetches a list of all the roles stored in the database
	 * @return array list of roles
	 */
	function index($eventId = null){
		if (isset($this->params['requested'])){
			if (isset($eventId))
				return $this->ReductionCode->listReductionCodesByEventId($eventId);
			else if ($this->Session->check('Event.id'))
				return $this->ReductionCode->listReductionCodesByEventId($this->Session->read('Event.id'));
			else if ($eventId == 'all' )
				return $this->ReductionCodes->find('all');
			else 
				return $this->ReductionCodes->find('all');
		}		
	}
	
	
	
	function create(){
		//check if previous step is done
		if (!$this->previousStepsAreDone($this)){
			$this->requestAction('steps/redirectToNextUnfinishedStep');
		}
		
		//No event selected redirect to events
		if (!$this->Session->read('Registration.Registration.event_id')) {
			$this->redirect(array('controller' => 'events', 'action' => 'index'));	
		}
		//Is there populated data in session - get it else false 
		if ($this->Session->check('Registration.ReductionCode')) {
			$reductionCodes = $this->Session->read('Registration.ReductionCode');
		} else {
			$reductionCodes = false;
		}
		
		
		$eventId = $this->Session->read('Registration.Registration.event_id');
		$this->set('eventName' , $this->ReductionCode->Event->field('name', array('id' => $eventId)));
		$this->set('errors', $this->Session->read('errors'));
		$this->Session->write('errors',null);
	}

	/*
	 * Fetches a list of all the roles stored in the database
	 * @return array list of roles
	 */
	function add() {
		$this->data['ReductionCode']['event_id'] = $this->Session->read('Event.id');
		$this->data['ReductionCode']['code'] = strtoupper($this->data['ReductionCode']['code']);
		if (!$this->ReductionCode->save($this->data)) {
			$this->Session->write('errors.reduction_codes', 'Rabattkoden du försöker skriva in <strong>finns redan</strong> kopplat till eventet.');
		} else {
			$this->Session->setFlash('<div class="grid_12"><p class="admin_info success">Rabattkoden sparades</p></div>');
		}
		$this->redirectBack();
	}
	
	function getFieldNamesForAdd() {
		
		if(!isset($this->params['requested'])) return;
		
		$fieldNamesAndLabels = array();
		
		$fieldNames = $this->ReductionCode->getFieldNames();
		$fieldLabels = $this->ReductionCode->translateFieldNames($fieldNames);
		
		for ($i = 0; $i < sizeof($fieldNames); $i++) {
			$fieldNamesAndLabels[$fieldLabels[$i]] = $fieldNames[$i];
		}
		
		$fieldNamesAndLabels = $this->ReductionCode->unsetArrayKeyByValue( $fieldNamesAndLabels, 'id' );
		$fieldNamesAndLabels = $this->ReductionCode->unsetArrayKeyByValue( $fieldNamesAndLabels, 'event_id' );
		
		return $fieldNamesAndLabels;
		
	}
	
	function getNumberOfPeopleByCode($code){
		$eventId = $this->Session->read('Event.id');
		$this->ReductionCode->getNumberOfPeopleByCode($code,$eventId);
	}
	function test(){
		debug($this->Session->read('Registration.Person'));
		$people = $this->Session->read('Registration.Person');
		$this->ReductionCode->getNumberOfPeopleWithCode(1,$people);						
		//$this->ReductionCode->getIdByCodeAndEventId('AB',7);
	}	

	/*
	 * reuduction_code doesn't contain any data so we just want to go to next unfinished step
	 */
	function next() {
		$this->updateStepStateToPrevious('reduction_codes', 'create');
		$this->requestAction('steps/redirectToNextUnfinishedStep');
	}
	
	function getReductionCodeCodeById($reductionCodeId) {
		if(!isset($this->params['requested'])) return;
		
		return $this->ReductionCode->field('code', array('id' => $reductionCodeId));		
	}
	
}
	



