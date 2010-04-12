<?php

	App::import('Sanitize');
	App::import('Inflector');

	
	class AppController extends Controller {
			
	/**
	 * Takes data from controllers and puts in in the sesssion so that we can save it later
	 * @param string $modelName to which name would you like to push (name should be the same as the model that will later be used to save the data)
	 * @param mixed $dataToPush this->data from the different controllers that contains the information that we'll later save
	 */
	function saveModelDataToSession(&$currentController) {
		try {
			$arrayName = 'Registration';
			$array = $this->Session->read($arrayName);
			$modelName = ucfirst(Inflector::singularize($currentController->params['controller']));
			$array[$modelName] = $currentController->data[$modelName];
			$this->Session->write($arrayName, $array);

		} catch(Exception $e) {
			return $e;

		}
		return true;
	}

	function previousStepsHasData(&$currentController){
		
		$steps = $this->Session->read('Event.steps');
		foreach ($steps as $step){
			if ($step['state'] != 'previous'){
				//if the first found step that isnt previous isn't the calling controller return false, else true
				if (
					$step['controller'] == $currentController->params['controller'] 
				&&	$step['action'] == $currentController->params['action']
				) return false;
				return true;
			}
		}
	}
	
	function updateStepState($controller , $action){
		$steps = $this->Session->read('Event.steps');
		foreach($steps as &$step) {
			if ($step['controller'] == ucfirst($controller) && $step['action'] == $action) {
				$step['state'] = 'previous';
			}
		}
		$this->Session->write('Event.steps', $steps);
	}
}