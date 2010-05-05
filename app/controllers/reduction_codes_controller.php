<?php
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
	
	function index(){
		if (isset($this->params['requested'])){
			return $this->ReductionCode->find('all',array ('recursive' => 0 ));
		}		
	}
	
	
	function create(){
		
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
}	

		/*
		 * Fetches a list of all the roles stored in the database
		 * @return array list of roles
		 */

		function add() {
			$fields = $this->ReductionCode->getRequiredFields();
			
			
	}	


