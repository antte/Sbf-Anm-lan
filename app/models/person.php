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

    
}
