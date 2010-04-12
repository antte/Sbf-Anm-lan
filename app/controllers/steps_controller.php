<?php

class StepsController extends AppController {
	
	function index($controller = null  , $action = null){
		if (!isset($this->params['requested'])) return;
		return $this->prepareStepsForView($this->Session->read('Event.steps'), $controller , $action);
		
	}

	/**
	 * Populate Session with event ids steps data
	 *
	 * @param $eventId
	 */
	function initializeSteps($eventId){
		$this->Session->write('Event.steps', $this->Step->getInitializedSteps($eventId));
	}
	
	function redirectToNextUnfinishedStep() {
		
		//we don't allow this action to be used unless requested
		if(!isset($this->params['requested'])) return;
		
		$steps = $this->Session->read('Event.steps');
		
		foreach($steps as $step) {
			if($step['state'] != 'previous') {
				$this->redirect(array('controller' => $step['controller'], 'action' => $step['action']));
			}
		}
	}
	
	/**
	 * makes an initialized steps array pretty for the view
	 * @param $steps initialized steps
	 */
	private function prepareStepsForView($steps, $controller ,$action) {
		$controller = ucfirst($controller);
		
		$i = 0;
		foreach($steps as &$step) {
			if ($controller == 'Registrations' && $action == 'receipt'){
				$step['classes'] = 'disabled';			
			} else {
				$step['classes'] = $step['state'];
			}
			if ($controller == $step['controller'] && $action == $step['action']) {
				//make current the step corresponding to the calling controller
				$step['classes'] = 'current';
			}
			
			if($i === 0) {
				$step['classes'] .= " first";
			} else if ($i === (sizeof($steps) -1) ){
				$step['classes'] .= " last";
			}
			
			$i++;
			unset($step['state']);
		}
		return $steps;
	}
	
	/**
	 * Checks to see if data exists in the right place and if so sets the correct steps state to previous
	 */
	function updateSteps() {
		$registration = $this->Session->read('Registration');
		
		foreach($registration as $modelName => $modelData) {
			if(!empty($modelData)) {
				
			}
		}
		//if data exists in session-> Registration.Person
		//if data exists in session-> Registration.Registrator
		//if data exists in session-> Registration.Registration.Review
	}
	
}
