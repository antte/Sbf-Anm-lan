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
    //TODO Är den här funktioen nödvändig?	
    /**
     * Matches one field against data (another field)
     * @param $data to match with
     * @param $field a field to match against
     */
	function verifies($data, $field) {
		$value = Set::extract($data, "{s}");
		return ($value[0] == $this->data[$this->name][$field]);
	}
	
	}