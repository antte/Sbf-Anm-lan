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
	function index(){
		if (isset($this->params['requested'])){
			return $this->ReductionCode->find('all',array ('recursive' => 0 ));
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
		$this->data['code'] = 'itchy'; 
		$this->data['number_of_people'] = '3'; 
		$this->data['code'] = Sanitize::clean($this->data['code']);
		$this->data['number_of_people'] = Sanitize::clean($this->data['number_of_people']);
		$this->ReductionCode->saveAll($this->data);
		debug($this->Session->read('commingFromUrl'));
		//$this->redirect($this->Session->read('commingFromUrl'));
	}	
		
	function getFieldNamesForAdd() {
		
		if(!isset($this->params['requested'])) return;
		
		$fieldNamesAndLabels = array();
		
		$fieldNames = $this->ReductionCode->getFieldNames();
		$fieldLabels = $this->ReductionCode->translateFieldNames($fieldNames);
		
		for ($i = 0; $i < sizeof($fieldNames); $i++) {
			$fieldNamesAndLabels[$fieldLabels[$i]] = $fieldNames[$i];
		}
		
		return $this->ReductionCode->unsetArrayKeyByValue( $fieldNamesAndLabels, 'id' );
		
	}
}
	



