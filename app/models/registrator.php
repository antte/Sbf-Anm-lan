<?php

	class Registrator extends AppModel {
		var $belongsTo = array('Registration');
		
		var $validate = array(
        	'first_name' => array (
				'required'  => true,
        		'allowEmpty'=> false,
				'rule'		=> array('maxLength', 127),
				'message' 	=> 'Förnamn måste finnas och vara högst 127 tecken.'
        	),
        	
        	'last_name' => array (
				'required'  => true,
        		'allowEmpty'=> false,
        		'rule' 		=> array('maxLength',127),
				'message' 	=> 'Efternamn måste finnas och vara högst 127 tecken.'
        	),
        	
        	'email' => array (
        		'rule1' => array(
        			'rule' => 'email',
        			'message' 	=> 'Ange en korrekt e-postadress.',
        			'required'  => true,
        			'allowEmpty'=> false
        		),
        		
        		'rule2' => array(
        			'rule' 		=> array('maxLength',127),
        			'message' 	=> 'Ange en korrekt e-postadress.',
        			'required'  => true,
        			'allowEmpty'=> false
        		)
       		),
	 		
        	'retype_email' => array (
	 			'email_verification' => array(
					'rule' => array('verifies', 'email'),
					'message' => 'Du måste fylla i samma email igen'
				)
	 		),
	 	
	 		'phone' => array (
	 			'required'  => true,
				'rule' 		=> array('maxLength',127),
	 			'message' 	=> 'Ange ett korrekt telefonnummer.'
			),
			
			'c_o' => array (
	      		'rule' 		=> array('maxLength',127),
				'message' 	=> 'Får inte vara högre än 127 tecken.'
			),
			
			'street_address' => array (
		    	'rule' 		=> array('maxLength',127),
				'required'  => true,
        		'allowEmpty'=> false,
				'message' 	=> 'Vi behöver din adress.'
	 		),
	 		
	 		'postal_code' => array (
		    	'required'  => true,
        		'allowEmpty'=> false,
		    	'rule' 		=> array('between',5, 6),
	 			'message' 	=> 'Ange ett korrekt postnummer.'
	 		),
	 		
	 		'city' => array (
		    	'rule' 		=> array('maxLength', 127),
	 			'required'  => true,
        		'allowEmpty'=> false,
	 			'message' 	=> 'Vi behöver veta din postort.'
	 		)
    	);
    	
    /**
     * Matches one field against data (another field)
     * @param $data to match with
     * @param $field a field to match against
     */
	function verifies($data, $field) {
		$value = Set::extract($data, "{s}");
		return ($value[0] == $this->data[$this->name][$field]);
	}
	
	/*
	 * Lists all the registrators
	 * @param $eventId the id of the event from which we find find the registrators
	 */
	function listAll($eventId) {
		
		$registrations = $this->Registration->findAllByEventId($eventId);
		
		//removes all the unimportant values from the array
		foreach($registrations as &$registration) {
			
			unset($registration['Event']);
			unset($registration['Person']);
			unset($registration['Registration']['event_id']);
			unset($registration['Registrator']['id']);
			unset($registration['Registrator']['registration_id']);
			
			$registration['number'] = $registration['Registration']['number'];
			$registration['created'] = $registration['Registration']['created'];
			if( $registration['Registration']['created'] != $registration['Registration']['modified'] ) {
				$registration['modified'] = $registration['Registration']['modified'];
			} else {
				$registration['modified'] = "";
			}
			
			$registration['first_name'] = $registration['Registrator']['first_name'];
			$registration['last_name'] = $registration['Registrator']['last_name'];
			$registration['email'] = $registration['Registrator']['email'];
			$registration['phone'] = $registration['Registrator']['phone'];
			$registration['c_o'] = $registration['Registrator']['c_o'];
			$registration['street_address'] = $registration['Registrator']['street_address'];
			$registration['city'] = $registration['Registrator']['city'];
			$registration['postal_code'] = $registration['Registrator']['postal_code'];
			$registration['extra_information'] = $registration['Registrator']['extra_information'];
			
			unset($registration['Registration']);
			unset($registration['Registrator']);
			
		}
		
		return $registrations;
		
	}
	
}