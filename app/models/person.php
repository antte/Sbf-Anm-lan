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
		$events = $this->Registration->findAllByEventId($eventId);
		$roles = $this->Role->find('list');
		foreach($events as &$event) :
			$event = $event['Person'];
			foreach($event as &$person) :
				foreach($roles as $key => $value) {
					if($key == $person['role_id']) {
						$person['role'] = $value;
					}
				}
				unset($person['id']);
				unset($person['registration_id']);
				unset($person['role_id']);
				
			endforeach;
			
		endforeach;
		return $events;
	}
    
}
