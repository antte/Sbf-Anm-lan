<?php

class StepsController extends AppController {

	function index(){

	}

	/**
	 * Populate Session with event ids steps data
	 *
	 * @param $eventId
	 */
	function initSteps($eventId){
		//if (isset($this->params['requested'])){
		$this->Session->write('Event.steps', $this->Step->rocketData($eventId));
		//}
	}

	/**
	 * Get steps from session belongin to current event.
	 * @param unknown_type $eventId
	 */
	function stepRocket(){
		if (isset($this->params['requested'])){
			return $this->Session->read('Event.steps');
		}
	}

	
	/**
	 * sets current to previous and next to current
	 */
	function advanceOneStep() {
		
		//we don't allow this action to be used unless requested
		if(!isset($this->params['requested'])) return;

		$steps = $this->Session->read('Event.steps');
		
		//change that step arrays state value to previous
		$currentFound = false;
		$i = 0;
		foreach($steps as &$step) { 
			if ($step['state'] == 'current') {
					$step['state'] = 'previous';
					$currentFound = true;
			} else if ($currentFound) {
				//sets the next step in the rocket as current
				$step['state'] = 'current';
				break;
			}
			$i++;
		}
		
		// after we change steps we need to write it to session or nothing will happen 
		// & we lets requester know whether it fails or succeeds
		return $this->Session->write('Event.steps', $steps);
	}
	
	function redirectToNextUnfinishedStep() {
		
		//we don't allow this action to be used unless requested
		if(!isset($this->params['requested'])) return;
		
		$steps = $this->Session->read('Event.steps');
		
		foreach($steps as $step) {
			if($step['state'] != 'previous') {
				$this->changeStepStateToCurrent($step);
				$this->redirect(array('controller' => $step['controller'], 'action' => $step['action']));
			}
		}
		
	}
	
	private function changeStepStateToCurrent($step) {
		$this->Session->write('Event.steps.' . ucfirst($step['controller']) .'/'. $step['action'] , 'current');
	}
	
}
