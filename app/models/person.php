<?php

App::import('Sanitize');

Class Person extends AppModel {
	var $altName = 'Anmälda';
	var $altDescribe = 'Personer som ingår i en sällskap';
	
	var $belongsTo = array(
			"Role",
			"Registration",
		);
	var $hasOne = array("ReductionCode");
			
	var $exportAllowed = true;
	
	var $unsetFields = array(
		'id',
		'reduction_code_id',
		'registration_id',
		'role_id'
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

	function listAllPeople($eventId) {
		$registrations = $this->Registration->findAllByEventId($eventId, array('recursive' => 0));
		$roles = $this->Role->find('list');
		
		foreach($registrations as &$registration) {
			$number = $registration['Registration']['number'];	
			// get booking number in this return
			// in view: fix so that each booking is a td
			$people = $registration['Person'];
			foreach($people as &$model) {
				foreach($roles as $id => $name) {
					if($id == $model['role_id']) {
						$model['role'] = $name;
						$model['number'] = $number;
					}	
				}
			}
			$registration['Person'] = $this->removeUnsetFieldsFromMultiple($people);
		}
		return $registration;
	}
	
	/**
	 * @overloaded
	 * Only sends along people from current event
	 */
	function getExcelDump() {
		$event = $this->requestAction('events');
		return $this->find('all', array('Registration.event_id' => $event['id'], 'recursive' => -1));
	}
    
}
