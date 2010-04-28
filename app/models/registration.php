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
		$this->Person->deleteAll		( array('Person.registration_id' => $registrationId )); //Funkar Inte						
		$this->Registrator->deleteAll	( array('Registrator.registration_id' => $registrationId ));	
	}
	
	/**
	 * 
	 */
	function putRegistrationInSession($registration, &$session) {
		// Retype email is not stored in the database, so we add it to the array
		$registration['Registrator']['retype_email'] = $registration['Registrator']['email'];
		
		$session->write('Registration', $registration);
		$session->write('Event.steps', $this->Event->Step->getInitializedSteps($registration['Registration']['event_id']));
	}
	
	function sendBookingMail($mailArray){	
		$this->Email->smtpOptions = array(
			'port'			=> '25', 
			'timeout'		=> '30',
			'host' 			=> 'localhost'
		);
		
		$this->Email->delivery 	= 'smtp';
		
		$this->Email->from		= 'noreply@sbf.se';
		$this->Email->to		= "{$mailArray['first_name']} {$mailArray['last_name']} <{$mailArray['email']}>";
		$this->Email->bcc		= "it sbf <it@sbf.se>";
		$this->Email->replyTo	= 'it@sbf.se';
		
		$event = $this->Session->read('Event');
		$this->Email->subject	= "Kvitto för din anmälan till {$mailArray['event_name']}";
		$this->Email->template	= 'default';
		$this->Email->sendAs	= 'both'; //both text and html
		$this->Email->send();
		
	
	}

	 function sendRegistrationConfirmMail($event,$registrator){
	 		$mailArray['first_name'] = $registrator['first_name'];
			$mailArray['last_name'] = $registrator['last_name'];
			$mailArray['email'] = $registrator['email'];
			$mailArray['event_name'] = $event['name'];
	 		$this->sendBookingMail($mailArray);
	 }
	 
	 function resendConfirmMail($registrationNumber){
	 	$registrationNumber = Sanitize::clean($registrationNumber);
		$registration = $this->findByNumber($registrationNumber);
		$mailArray['first_name'] = $registration['Registrator']['first_name'];
		$mailArray['last_name'] = $registration['Registrator']['last_name'];
		$mailArray['email'] = $registration['Registrator']['email'];
		$mailArray['event_name'] = $registration['Event']['name'];
		
		//$this->sendBookingMail($mailArray);
}
	 
}
