<?php

	Class Registration extends AppModel {
		var $belongsTo = "Event";
		var $hasMany = "Person";
		
		var $validate = array(
        	'first_name' => array (
				'rule' => array('notEmpty', 'maxLength',127),
				'message' => 'F&ouml;rnamn m&aring;ste finnas och vara h&ouml;gst 127 tecken.'
        	),
        	'last_name' => array (
				'rule' => array('notEmpty', 'maxLength',127),
				'message' => 'Efternamn m&aring;ste finnas och vara h&ouml;gst 127 tecken.'
        	),
        	'email' => array (
        		'rule' => 'email',
				'rule' => array('maxLength',127),
        		'rule' => 'notEmpty',
				'message' => 'Ange en korrekt e-postadress.'
        	),
			'role_id' => array (
		    	'rule' => array(
        			'multiple', array('min' => 1)	
        		),
        		'message' => 'Du m&aring;ste v&auml;lja i vilken roll du vill anm&auml;la dig.'
	 		),
	 		'retype_email' => array (
		    	/* TODO equalTo: "#RegistrationEmail", */
		    	'rule' => 'email',
				'rule' => array('maxLength',127),
        		'rule' => 'notEmpty',
				'message' => 'Ange samma e-postadress.'
	 		),
	 		'phone' => array (
				'rule' => array('maxLength',127),
	 			'message' => 'Ange ett korrekt telefonnummer.'
			),
			'c_o' => array (
	      		'rule' => array('maxLength',127),
				'message' => 'F&aring;r inte vara ht&ouml;gre &auml;n 127 tecken.'
			),
			'street_address' => array (
		    	'rule' => array('notEmpty', 'maxLength', 127),
				'message' => 'Vi beh&ouml;ver din adress.'
	 		),
	 		'postal_code' => array (
		    	'rule' => 'notEmpty',
		    	'rule' => array('between',5, 5),
		    	'rule' => 'numeric',
	 			'message' => 'Ange ett korrekt postnummer.'
	 		),
	 		'city' => array (
		    	'rule' => array('notEmpty', array('maxLength',127)),
		    	//'rule' => array('maxLength',127),
	 			'message' => 'Vi beh&ouml;ver veta din postort.'
	 		)
    	);
    	
    	// TODO check to make sure that event_id is correct (is an event etc)
		
	}