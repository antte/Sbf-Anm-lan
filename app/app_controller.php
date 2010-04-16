<?php

	App::import('Sanitize');
	App::import('Inflector');

	
	class AppController extends Controller {
			
	/**
	 * Takes data from controllers and puts in in the sesssion so that we can save it later
	 * @param string $modelName to which name would you like to push (name should be the same as the model that will later be used to save the data)
	 * @param mixed $dataToPush this->data from the different controllers that contains the information that we'll later save
	 */
	function saveModelDataToSession(&$currentController,$data = null) {
		try {
			$arrayName = 'Registration';
			$array = $this->Session->read($arrayName);
			$modelName = ucfirst(Inflector::singularize($currentController->params['controller']));
			if (isset($data)){
				$array[$modelName] = $data;
			} else {
				$array[$modelName] = $currentController->data[$modelName];
			}
			$this->Session->write($arrayName, $array);

		} catch(Exception $e) {
			throw $e;

		}
		return true;
	}

	function previousStepsAreDone(&$currentController){
		
		$steps = $this->Session->read('Event.steps');
		foreach ($steps as $step){
			if ($step['state'] != 'previous'){
				if (
					$step['controller'] == ucfirst($currentController->params['controller'])
				&&	$step['action'] == ucfirst($currentController->params['action'])
				) return false;
				return true;
			}
		}
	}
	
	/**
	 * All previous steps up until the step specified but not including the step specified are set to previous
	 * @param string $controller
	 * @param string $action
	 */
	function setPreviousStepsToPrevious($controller , $action){
		$steps = $this->Session->read('Event.steps');
		foreach($steps as &$step) {
			if ($step['controller'] == ucfirst($controller) && $step['action'] == $action) {
				break;
			}
			$step['state'] = 'previous';
		}
		$this->Session->write('Event.steps', $steps);
	}
	
<<<<<<< HEAD
	function updateStepStateToPrevious($controller , $action){
=======
	/**
	 * step specified becomes previous
	 * @param unknown_type $controller
	 * @param unknown_type $action
	 */
	function updateStepState($controller , $action){
>>>>>>> 48318fc9f63c2136b47d1e8674561ed4d13e568e
		$steps = $this->Session->read('Event.steps');
		foreach($steps as &$step) {
			if ($step['controller'] == ucfirst($controller) && $step['action'] == $action) {
				$step['state'] = 'previous';
			}
		}
		$this->Session->write('Event.steps', $steps);
	}
}
