<?php
class AdminsController extends AppController {

	function login(){
		
	}

	function addLogin(){
		
	}
	
	/**
	 * Made to be requested by the admin panel
	 * @return admin steps (event steps without review and receipt)
	 */
	function steps() {
		
		if(!isset($this->params['requested'])) return;
		
		$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		
		/**
		 * remove registration review and registration receipt from steps before returning
		 */
		foreach ($steps as &$step) {
			if ( $step['controller'] == 'Registrations' && 
			( $step['action'] == 'review' || $step['action'] == 'receipt' ) ) {
				unset($step);
				continue;
			}
			$step['classes'] = $step['state'];
			unset($step['state']);
		}
		
		return $steps;
	}
	
}

