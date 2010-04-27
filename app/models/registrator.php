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
	function listAllRegistrators($eventId) {
		$registrators = $this->find('all', array('conditions' => 
			array(
				'Registration.event_id' => $eventId
			),
			'fields' => array(
				'Registration.number', 
				'Registration.modified', 
				'Registration.modified_admin', 
				'Registration.modified_admin_id',
				'Registrator.first_name', 
				'Registrator.last_name', 
				'Registrator.email', 
				'Registrator.phone',
			)
		));
		
		return $registrators;
		
	}
	
	/**
	 * takes findData from listAllRegistrators and returns human readable field names for the html->tableHeaders() method
	 * @param array $findData data returned from the listAllRegistrators function (should work with other functions that has many registrators and associated data)
	 */
	function getTranslatedFieldNames($findData) {
		$fieldNames = array();
		
		//we only need the first record found (all records have the same names presumably)
		foreach($findData[0] as $modelName => &$modelData) {
			foreach($modelData as $fieldName => $fieldValue) {
				$fieldNames[] = $modelName.'.'.$fieldName;
			}
		}
		
		return $this->translateFieldNames($fieldNames);
		
	}
	
}