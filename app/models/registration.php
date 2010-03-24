<?php
	
	App::import('Sanitize');

	Class Registration extends AppModel {
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
		var $validate = array(
        	'first_name' => array (
				'rule'	 =>	'notEmpty',
				'rule'		=> array('maxLength' => 127),
				'message' 	=> 'Förnamn måste finnas och vara högst 127 tecken.'
        	),
        	'last_name' => array (
				'rule'	 =>	'notEmpty',
        		'rule' 		=> array('maxLength' => 127),

				'rule' 		=> array('notEmpty', 'maxLength',127),
				'message' 	=> 'Förnamn måste finnas och vara högst 127 tecken.'
        	),
        	'last_name' => array (
				'rule' 		=> array('notEmpty', 'maxLength', 127),
				'message' 	=> 'Efternamn måste finnas och vara högst 127 tecken.'
        	),
        	'email' => array (
        		'rule' 		=> 'email',
				'rule' 		=> array('maxLength',127),
        		'rule' 		=> 'notEmpty',
				'message' 	=> 'Ange en korrekt e-postadress.'
        	),
			'role_id' => array (
		    	'rule' => array(
        			'multiple', array('min' => 1)	
        		),
        		'message' => 'Du måste välja i vilken roll du vill anmäla dig.'
	 		),
	 		'retype_email' => array (
		    	/* TODO equalTo: "#RegistrationEmail", */
		    	'rule' 		=> 'email',
				'rule' 		=> array('maxLength', 127),
        		'rule' 		=> 'notEmpty',
				'message' 	=> 'Ange samma e-postadress.'
	 		),
	 		'phone' => array (
				'rule' 		=> array('maxLength',127),
	 			'message' 	=> 'Ange ett korrekt telefonnummer.'
			),
			'c_o' => array (
	      		'rule' 		=> array('maxLength',127),
				'message' 	=> 'Får inte vara högre än 127 tecken.'
			),
			'street_address' => array (
		    	'rule' 		=> array('notEmpty', 'maxLength',127),
				'message' 	=> 'Vi behöver din adress.'
	 		),
	 		'postal_code' => array (
		    	'rule' 		=> 'notEmpty',
		    	'rule' 		=> array('between',5, 6),
	 			'message' 	=> 'Ange ett korrekt postnummer.'
	 		),
	 		'city' => array (
		    	'rule' 		=> array('notEmpty', 'maxLength', 127),
	 			'message' 	=> 'Vi behöver veta din postort.'
	 		)
    	);
    	
    	// TODO check to make sure that event_id is correct (is an event etc)
	
    	/**
    	 * saves all data relating to a registration and returns a status message
    	 * @param $registration
    	 * @return array $status['code'] similar to http error codes
    	 */
    	function saveAndReturnStatus($registration) {
    		$success = $this->saveAll($registration);
    		if ($success) {
    			debug("hej");
    		} else {
    			debug("nej");
    		}
    		/*
    		$status = array();
    		if($this->saveAll($registration)) {
    			$status['flash'] = "Tack för din anmälan";
    			$status['code'] = 2;
    		} else {
    			$status['flash'] = "Det blev fel";
    			$status['code'] = 4;
    		}
    		return $status;
    		*/
    	}
    	
    	
    	private function isDuplicate($data) {
    		$duplicateRegistration = $this->find('first', array(
				'conditions' => array(
					'event_id' 		=> $data['Registration']['event_id'],
					'first_name' 	=> $data['Registration']['first_name'],
					'last_name' 	=> $data['Registration']['last_name'],
					'email' 		=> $data['Registration']['email']
				)));
			if (empty($duplicateRegistration)) return false;
			else return true;
    	}
    	
	}