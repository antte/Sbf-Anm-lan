<?php
	
	App::import('Sanitize');

	Class Registration extends AppModel {
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
		var $validate = array(
        	'first_name' => array (
				'rule' 		=> array('notEmpty', 'maxLength',127),
				'message' 	=> 'F&ouml;rnamn m&aring;ste finnas och vara h&ouml;gst 127 tecken.'
        	),
        	'last_name' => array (
				'rule' 		=> array('notEmpty', 'maxLength',127),
				'message' 	=> 'Efternamn m&aring;ste finnas och vara h&ouml;gst 127 tecken.'
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
        		'message' => 'Du m&aring;ste v&auml;lja i vilken roll du vill anm&auml;la dig.'
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
				'message' 	=> 'F&aring;r inte vara ht&ouml;gre &auml;n 127 tecken.'
			),
			'street_address' => array (
		    	'rule' 		=> array('notEmpty', 'maxLength', 127),
				'message' 	=> 'Vi beh&ouml;ver din adress.'
	 		),
	 		'postal_code' => array (
		    	'rule' 		=> 'notEmpty',
		    	'rule' 		=> array('between',5, 6),
	 			'message' 	=> 'Ange ett korrekt postnummer.'
	 		),
	 		'city' => array (
		    	'rule' 		=> array('notEmpty', array('maxLength',127)),
	 			'message' 	=> 'Vi beh&ouml;ver veta din postort.'
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
    	 * status['validationErrors']
    	 */
    	function save_and_return_status($data) {
    		$status = array();
    		
    		$clean_data = Sanitize::clean($data);
    		$status['event_id'] = $clean_data['Registration']['event_id'];
    		
    		$status['flash'] = "Det blev fel..."; //Default feedback message
    		
	    	if(!empty($data)) {
				
				//Before we save the data we check to see if a similar registration has already been registered
				$duplicate_registration = $this->find('first', array(
				'conditions' => array(
					'event_id' 		=> $clean_data['Registration']['event_id'],
					'first_name' 	=> $clean_data['Registration']['first_name'],
					'last_name' 	=> $clean_data['Registration']['last_name'],
					'email' 		=> $clean_data['Registration']['email']
				)));
				
				if (empty($duplicate_registration)) {
					if($this->save($clean_data)) { 
						// registration data saved successfully
						$status['flash'] = "Tack för din anmälan, {$clean_data['Registration']['first_name']}.";
						$status['type'] = 2;
					} else {
						if (!is_numeric($clean_data['Registration']['event_id'])) { 
							//Normally the event_id should be present but a malicious user could omit or change it so we need to verify it
							// TODO use security component to verify instead
							$status['flash'] = "Hur tycker du själv att det går?";
							$status['type'] = 400; // TODO controller should send to index without passing go
						}
						
						//save was unsuccessful
						$status['flash'] = "Det blev fel.";
						$status['type'] = 4;
						
					}
				} else {
					$status['flash'] = "Det verkar som att du redan är anmäld.";
					$status['type'] = 4;
				}
			
			} else {
				$status['flash'] = "Hur tycker du själv att det går?";
				$status['type'] = 4;
			}
    		
    		return $status;
    	}
    	
	}