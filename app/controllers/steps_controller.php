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
}