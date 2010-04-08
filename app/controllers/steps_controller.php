<?php

class StepsController extends AppController {

	function index(){
		
	}
	
	function stepRocket($current = null) {
		
		if($current){
			//makes a string first character uppercase
			$current = ucfirst($current);
		}
		echo "<br><br>current: " . $current . "<br><br>";
		
		$eventId = $this->Session->read('Registration.Registration.event_id');

		$steps = $this->Step->Event->findById($eventId);

		//unset($steps['Registration'], $steps['Event']);
		$steps = $steps['Step'];

		$rocket = array();

		echo "Registration session:<br/>";
		debug($this->Session->read('Registration'));

		foreach($steps as $i => $step) {
				
			$label = $step['name'];
			$controller = $step['controller'];
			$action = $step['action'];
			
			// controller  = plural
			$controller = Inflector::singularize($controller);
			// controller = singular
			
			//debug(array_key_exists($controller, $steps));
			//debug($this->Session->read('Registration'));
			
			debug($this->Session->read('Registration.' . $controller));
			
			echo "KOLLA IN DENNA SKUMMA SAK!!! CURRENT: " . $current . " =!=?=!= CONTROLLER: " . $controller . "!!<br/>";
			echo "controller i plural: " . Inflector::pluralize($controller) . "<br><br>";
			
			
			if($current == Inflector::pluralize($controller)){
				
				$state = 'current';
				
			}
			
			
			else if(array_key_exists($controller, $this->Session->read('Registration')) && $controller != 'Registration'){
				$state = 'previous';
			}
			
			else {
				$state = 'coming';
			}
			
			$rocket[$i]['label'] = $label;
			$rocket[$i]['state'] = $state;
			$rocket[$i]['controller'] = strtolower(Inflector::pluralize($controller));
			$rocket[$i]['action'] = $action;
				
		}
		
		debug($rocket);

		return $rocket;

		//return $this->Event->Step->findById($eventId);

	}

}