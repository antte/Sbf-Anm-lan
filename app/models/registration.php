<<<<<<< HEAD
﻿it<?php
=======
﻿<?php
	
	App::import('Sanitize');
>>>>>>> ebb87f043c2c900aa27e933b417c03cde8ee0713

	Class Registration extends AppModel {
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
		var $validate = array(
        	'first_name' => array (
				'rule' 		=> array('notEmpty', 'maxLength',127),
				'message' 	=> 'Förnamn måste finnas och vara högst 127 tecken.'
        	),
        	'last_name' => array (
				'rule' 		=> array('notEmpty', 'maxLength',127),
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
				'rule' 		=> array('maxLength',127),
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
		    	'rule' 		=> array('notEmpty', 'maxLength', 127),
				'message' 	=> 'Vi behöver din adress.'
	 		),
	 		'postal_code' => array (
<<<<<<< HEAD
		    	'rule' => 'notEmpty',
		    	'rule' => array('between',5, 5),
		    	'rule' => 'numeric',
	 			'message' => 'Ange en korrekt postnummer.'
=======
		    	'rule' 		=> 'notEmpty',
		    	'rule' 		=> array('between',5, 6),
	 			'message' 	=> 'Ange ett korrekt postnummer.'
>>>>>>> ebb87f043c2c900aa27e933b417c03cde8ee0713
	 		),
	 		'city' => array (
		    	'rule' 		=> array('notEmpty', array('maxLength',127)),
	 			'message' 	=> 'Vi behöver veta din postort.'
	 		)
    	);
    	
    	// TODO check to make sure that event_id is correct (is an event etc)
		
    	/**
    	 * Returns a message so that the controller can flash it.
    	 * Returns how the save went
    	 * @param $data $this->data from the controller
    	 * @return 
    	 * status['flash'] 			contains a user feedback message
    	 * status['type'] = 2 		for success
    	 * status['type'] = 4 		for failure
    	 * status['type'] = 400 	for a bad request (data is weird)
    	 * status['event_id']		contains the event_id from the data
    	 */
    	function saveAndReturnStatus($data) {
    		$status = array();
    		
    		$cleanData = Sanitize::clean($data);
    		$status['event_id'] = $cleanData['Registration']['event_id'];
    		
    		$status['flash'] = "Det blev fel..."; //Default feedback message
    		
	    	if(empty($data)) {
	    		$status['flash'] = "Hur tycker du själv att det går?";
				$status['type'] = 4;
				return $status;
	    	}
				
			//Before we save the data we check to see if a similar registration has already been registered
			if ($this->isDuplicate($cleanData)) {
				$status['flash'] = "Det verkar som att du redan är anmäld.";
				$status['type'] = 4;
				return $status;
			}
			
			if(!$this->save($cleanData)) { 
				if (!is_numeric($cleanData['Registration']['event_id'])) { 
					//Normally the event_id should be present but a malicious user could omit or change it so we need to verify it
					// TODO use security component to verify instead
					$status['flash'] = "Hur tycker du själv att det går?";
					$status['type'] = 400;
					return $status;
				}
				//save was unsuccessful
				$status['flash'] = "Det blev fel.";
				$status['type'] = 4;
				return $status;
			}
			
			// registration data saved successfully
			$status['flash'] = "Tack för din anmälan, {$cleanData['Registration']['first_name']}.";
			$status['type'] = 2;
				    		
    		return $status;
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