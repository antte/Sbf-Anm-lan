<?php

App::import('Sanitize');

Class Registration extends AppModel {
	var $belongsTo = array('Event');
	var $hasMany = array('Invoice','Person');
	var $hasOne = array('Registrator');
	var $actsAs = array('Containable');
	var $exportAllowed = true;
	
	var $exportFields = array (
			'Registration.number', 
			'Registration.created',
			'Person.first_name',
			'Person.last_name' ,
			'Registrator.email',
			'Registrator.extra_information' 
		); 
	
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
	
	/**
	 * specific
	 * @overloaded
	 */
	function getExportDump(){
		
		$exportFieldNames = $this->translateFieldNames($this->exportFields);
		$exportFields = $this->modelFieldNamesToTableFieldNames($this->exportFields);
		$columns = "";
		foreach ($exportFields as $i => $exportField){
			$columns .= "$exportField as ` {$exportFieldNames[$i]}`";  
			
			//so long as we're not on the last one add comma at the end
			if (!(sizeof($exportFields)-1 == $i))			
				$columns .= ",";
				  
		}
		
		$dump = $this->query("
					SELECT 	 $columns
					FROM registrations 
					LEFT JOIN people ON registrations.id = people.registration_id
					LEFT JOIN roles ON people.role_id = roles.id
					LEFT JOIN registrators ON registrators.registration_id = registrations.id 
					LEFT JOIN admins ON registrations.modified_admin_id = admins.id 
					GROUP BY  people.id 
					");
		$a = array();
		foreach ($dump as $i => $row){
			foreach ($row as $modelName => $dataSet){
				foreach($dataSet as $fieldKey => $fieldValue){
					//formats the array as the view wants it
					$a[$i]['whatever'][$fieldKey] = $fieldValue;
				}
			}
		}
		return $a;
	}
	 
}
