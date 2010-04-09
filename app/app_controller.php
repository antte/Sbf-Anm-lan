<?php

	App::import('Sanitize');
	App::import('Inflector');
		
	class AppController extends Controller {
		
		/**
		 * This function will blow up if the $controller doesn't have any data to save (it likes to blow up in more cases)
		 * @param $controller reference to the calling controller ($this from the controllers perspective)
		 */
		function finalizeStep(&$currentController) {
			
			if(!$this->requestAction('steps/advanceOneStep')){
				throw new Exception('Can\'t advance one step');
			}
				
			//saves the data to session
			try{
				$this->saveModelDataToSession($currentController);
			} catch (Exception $e) {
				throw($e);
			}
			
		}
	
	/**
	 * Takes data from controllers and puts in in the sesssion so that we can save it later
	 * @param string $modelName to which name would you like to push (name should be the same as the model that will later be used to save the data)
	 * @param mixed $dataToPush this->data from the different controllers that contains the information that we'll later save
	 */
	private function saveModelDataToSession(&$currentController) {
		try {
			$arrayName = 'Registration';
			$array = $this->Session->read($arrayName);
			$modelName = ucfirst(Inflector::singularize($currentController->params['controller']));
			$array[$modelName] = $currentController->data[$modelName];
			$this->Session->write($arrayName, $array);
			$this->Session->write($arrayName.'progress', $modelName . "/create");

		} catch(Exception $e) {
			return $e;

		}
		return true;
	}
		
}