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
	 * Check and kreates unique number obs don't save just check if exists
	 * @param $length = 6
	 * @param $possible = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
	 * @param $field = numbers
	 */
	function generateUniqueNumber ($length = 6, $possible = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $field = 'number'){
		// initialize variables
		$string = "";
		$i = 0;

		// add random characters to $string until $length is reached
		do {
			while ($i < $length) {
				// pick a random character from the possible ones
				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

				// we don't want this character if it's already in the string
				if (!strstr($string, $char)) {
					$string .= $char;
					$i++;
				}
			}
		}while($this->findByNumber($string));
		return $string;
	}
	
	/**
	 * 
	 * @param int $registrationId registration to delete
	 */
	function deleteAllRegistrationRelatedDataById($registrationId) {
		$this->deleteAll				( array('Registration.id' => $registrationId));
		$this->Person->deleteAll		( array('Person.registration_id' => $registrationId ));						
		$this->Registrator->deleteAll	( array('Registrator.registration_id' => $registrationId ));	
	}

	
}


