<?php
App::import('Sanitize');
class ReductionCodesController extends AppController {
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
				
	}

	/*
	 * Fetches a list of all the roles stored in the database
	 * @return array list of roles
	 */
	function add() {
		$this->data['ReductionCode']['event_id'] = $this->Session->read('Event.id');
		$this->ReductionCode->save($this->data);
		$commingFromUrl = $this->Session->read('commingFromUrl');
		$this->redirect( array('controller' => $commingFromUrl['controller'], 'action' => $commingFromUrl['action'] . '/'. $commingFromUrl['pass'][0] ) );
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
}
	



