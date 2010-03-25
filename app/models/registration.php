<?php
	
	App::import('Sanitize');

	Class Registration extends AppModel {
		var $belongsTo = array('Event');
		var $hasMany = array('Person');
		var $hasOne = array('Registrator');
		
		var $validate = array(
        	'event_id' => array (
				'required'  => true,
        		'allowEmpty'=> false,
				'rule'		=> 'numeric',
        	)
    	);
	
    	/**
    	 * Saves all data relating to a registration and returns a status message
    	 * @param $registration
    	 * @return array $status['code'] similar to http error codes
    	 */
    	function saveAndReturnStatus($registration) {
    		$success = $this->saveAll($registration);
    		// TODO we'll want to see if registrations gets an associated event_id, if not we can get it from session (eventId)
    		// TODO send status back
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
    	
	}
	
	
	
	
	
	
	