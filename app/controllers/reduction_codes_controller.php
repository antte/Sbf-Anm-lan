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
			$this->data['code'] = 'jakan'; 
			$this->data['number_of_people'] = 'jakan'; 
			debug($this->data);
			$this->data['code'] = Sanitize::clean($this->data['code']);
			$this->data['number_of_people'] = Sanitize::clean($this->data['number_of_people']);
			$this->ReductionCode->save($this->data);
		}
			

	
	function getFieldNamesForAdd() {
		
		if(!isset($this->params['requested'])) return;
		
		$fieldNames = $this->ReductionCode->getFieldNames();
		
		return $this->ReductionCode->unsetArrayKeyByValue($fieldNames, 'id');
		
	}
	
	}	
	



