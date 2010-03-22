<?php

App::import('Sanitize');

Class Person extends AppModel {

	var $belongsTo = array(
			"Role",
			"Registration" 
			);

/*	var $validate = array(
        'first_name' => array (
		'rule' 		=> array('notEmpty', 'maxLength',127),
		'message' 	=> 'Förnamn måste finnas och vara högst 127 tecken.'
		),
        'last_name' => array (
		'rule' 		=> array('notEmpty', 'maxLength',127),
		'message' 	=> 'Efternamn måste finnas och vara högst 127 tecken.'
		),
	'role_id' => array (
    	'rule' => array(
        	'multiple', array('min' => 1)	
		),
        'message' => 'Du måste välja i vilken roll du vill anmäla dig.'
        ));

}
// TODO check to make sure that event_id is correct (is an event etc)

/**
 * Returns a message so that the controller can flash it.
 * Returns how the save went
 * @param $data $this->data from the controller
 * @return
 * status['flash'] 				contains a user feedback message
 * status['type'] = 2 			for success
 * status['type'] = 4 			for failure
 * status['type'] = 400 		for a bad request (data is weird)
 * status['registration_id']	contains the registration_id from the data
 */
function cleanSave($data) {
	$cleanData = Sanitize::clean($data);
	$this->save($cleanData);
}
