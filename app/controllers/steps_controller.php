<?php

class StepsController extends AppController {
	var $altName = 'Steg';
	var $altDescribe = 'Steg i ett event';
	
	function index($controller = null  , $action = null){
		if (!isset($this->params['requested'])) return;
		
		return $this->prepareStepsForView( $controller , $action );
	}

	/**
	 * Populate Session with event ids steps data
	 *
	 * @param $eventId
	 */
	function initializeSteps($eventId){
		$this->Session->write('Event.steps', $this->Step->getInitializedSteps($eventId));
	}
	
	/*
	 * Finds the first step in the session that isn't in previous state and redirects to it
	 */
	function redirectToNextUnfinishedStep() {
		//we don't allow this action to be used unless requested
		if(!isset($this->params['requested'])) 
			return;
		
		$steps = $this->Session->read('Event.steps');
		foreach($steps as $step) {
			if(($step['state'] != 'previous') && $step['label'] != '') {
				$this->redirect(array('controller' => $step['controller'], 'action' => $step['action']));
			}
		}
	}
	
	/*
	 * When you dont want to use initializeSteps to autimatically write steps to session
	 */
	function getInitializedSteps($eventId) {
		if(!isset($this->params['requested'])) return;
		return $this->Step->getInitializedSteps($eventId);
	}
	
	/**
	 * makes an initialized steps array pretty(dumb) for the view
	 * @param $steps initialized steps
	 */
	private function prepareStepsForView($controller ,$action) {
		$steps = $this->Session->read('Event.steps');
		$controller = ucfirst($controller);
		
		$stepCounter = 0;
		$firstComingStepFound = false;
		$newSteps = array();
		//The function of this foreach is to arrange css classes so that the view can handle it correctly
		foreach($steps as $key=> &$step) {
			//receipt should always be disabled if its not current
			if (isset($step['label']) && $step['label'] !=''){
				
				if ($controller == 'Registrations' && $action == 'receipt'){
					$step['classes'] = 'disabled';
				} else {
					$step['classes'] = $step['state'];
				}
				
				if ($step['state'] == 'coming' && $firstComingStepFound != true) {
					$step['classes'] = 'started'; 
					$firstComingStepFound = true;	
				}
				
				if ($controller == $step['controller'] && $action == $step['action']) {
					//make current the step corresponding to the calling controller
					$step['classes'] = 'current';
				}
							
				if($stepCounter === 0) {
					$step['classes'] .= " first";
				} else if ($stepCounter === (sizeof($steps) -1) ){
					$step['classes'] .= " last";
				}
				
				$stepCounter++;
				unset($step['state']);
				$newSteps[$key]= $step;
			}	
		}
		return $newSteps;
	}
	
	function debug(){
		//return $this->Session->read('Registration');
	}
	
}