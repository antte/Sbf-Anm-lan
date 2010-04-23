<?php

App::import('Sanitize');

Class Person extends AppModel {

	var $belongsTo = array(
			"Role",
			"Registration" 
			);
	
	var $validate = array(
        'first_name' => array (
			'rule' 		=> array('notEmpty', 'maxLength'=>127),
			'message' 	=> 'Förnamn måste finnas och vara högst 127 tecken.'
		),
        'last_name' => array (
			'rule' 		=> array('notEmpty', 'maxLength'=>127),
			'message' 	=> 'Efternamn måste finnas och vara högst 127 tecken.'
		),
		'role_id' => array (
    		'rule' => array(
        		'multiple', array('min' => 1)	
			),
        	'message' => 'Du måste välja i vilken roll du vill anmäla dig.'
        )
    );

	function listAllPeople($eventId) {
		$registrations = $this->Registration->findAllByEventId($eventId, array('recursive' => 0));
		$roles = $this->Role->find('list');
		
		foreach($registrations as &$registration) :
			$number = $registration['Registration']['number'];	
			// get booking number in this return
			// in view: fix so that each booking är en td
			$registration = $registration['Person'];
			foreach($registration as &$model) :
				foreach($roles as $id => $name) {
					if($id == $model['role_id']) {
						$model['role'] = $name;
						$model['number'] = $number;
					}	
				}
				unset($model['id']);
				unset($model['registration_id']);
				unset($model['role_id']);
				
			endforeach;
			
		endforeach;
		return $registrations;
	}
    
}
