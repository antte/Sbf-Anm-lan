<?php

	Class ReductionCode extends AppModel {
		var $primaryKey = 'code'; 
		var $exportAllowed = true;
		var $altName = 'Rabatter';
		var $hasMany = array(
			'Person'
		);
		var $belongsTo = array(
			'Event'
		);
		var $unsetFields = array(
			'id',
			'event_id'
		);		
		var $validate = array(
			'code' => array(
				'rule1' => array(
					'required'  => true,
					'allowEmpty'=> false,
					'rule'		=> array('maxLength', 127),
					'message' 	=> 'Rabattkoden måste vara ifylld.'
				),
				'rule2' => array(
					'rule' => 'alphaNumeric',
					'message' => 'Rabattkoden får bara innehålla bokstäver och siffror.'
				),
				'rule3' => array(
					'rule' => 'isUnique',
					'message' => 'Den här rabattkoden är redan använd, fyll i en ny.'
				)
			),
			'number_of_people' => array(
				'required'  => true,
				'allowEmpty'=> false,
				'rule'		=> array('maxLength', 127),
				'message' 	=> 'Antal personer måste vara ifyllt.'
			)
		);
		
		function beforeValidate() {
			//the code can't already exist
			return !($this->codeExists($this->data['ReductionCode']['code'], $this->data['ReductionCode']['event_id']));
		}
		
		/*
		 * 
		 * @return a selection of colums from a event 
		 */
		function listReductionCodesByEventId($eventId){
			$reductionCodes = $this->find('all' ,array ('conditions' => array('event_id'=> $eventId),'recursive'=> -1 ));
			foreach ($reductionCodes as $i => &$reductionCode){
				foreach ($this->unsetFields as $unsetField) {
					unset($reductionCode['ReductionCode'][$unsetField]);
				}
			}
			
			return $reductionCodes; 
		}
		
		function getNumberOfPeopleById($id){
			return ( $this->field('number_of_people', array('id'=> $id)));
		}
		
		/*
		 * Get amount of unused code, 
		 * @ return int numberleft
		 
		function getNumberOfPeopleLeft($id, $reduction = 0) {
			$peopleWithReductionCode = $this->Person->find('all', array('conditions' => array('reduction_code_id' => $id)));
			debug($peopleWithReductionCode);
						
			$path = '/Person[reduction_code_id='. $id.']';
			$result	= Set::extract($path,$people);
			debug($result);
			return $maxPeopleWithCode - $peopleWithCode; 				
		}*/
		
		function getNumberOfPeopleWithReductionCodeById($id) {
			$peopleWithReductionCode = $this->Person->find('all', array('conditions' => array('reduction_code_id' => $id)));
			//$peopleWithReductionCode = $this->Person->findByReductionCodeId();
			
			return sizeof($peopleWithReductionCode);
		}
		
		/**
		 * Checks to see if this combination of code and event_id is unique
		 * @param $code reduction code
		 * @param $eventId reduction event_id
		 * Or if you call it with only one parameter
		 * @param $id
		 * it looks to see if that id exists
		 * @return true/false
		 */
		function codeExists($id){
			if(func_num_args() === 1) {
				if ($this->field('id',array('id' => $id))) return true;
					else return false;
			} else if(func_num_args() === 2) {
				$reductionCodes = $this->find('all', array('recursive' => -1 ,'conditions' => array('code' => func_get_arg(0))));
				if(sizeof($reductionCodes) > 0) return true;
					else return false;
			} else {
				return;
			}
		}
		
		function getNumberOfPeopleWithCode($id, $registration){

		//hämta antal personer med reducrtion_code.id ur DB 
		$peopleWithReductionCodeFromDb = $this->Person->find('all', array('conditions' => array('reduction_code_id' => $id)));			

		//räkna ut antal personer i arrayen som har reduction_code_id = id
		$amountUsed = sizeof($peopleWithReductionCodeFromDb);
		
		//result contains all people with reduction code id id in session
		$path = '/Person[reduction_code_id='. $id.']';
		$peopleWithReductionCodeFromSession	= Set::extract($path,$registration);
		
		if (!is_numeric($registration))
			$increase = 0;
		
		//debug($peopleWithReductionCodeFromSession);
		//debug($peopleWithReductionCodeFromDb);
		$duplicate = 0;
		foreach ($peopleWithReductionCodeFromDb as $j => $dbPerson ){
			foreach ($peopleWithReductionCodeFromSession as $i => $sessionPerson){
				if (isset($sessionPerson['Person']['id'])){
					if ($sessionPerson['Person']['reduction_code_id']== $dbPerson['Person']['reduction_code_id'] &&
			  			$sessionPerson['Person']['id'] == $dbPerson['Person']['id'] )  
						$duplicate++;
				} 
			}					
		}
				
				
			$amount = ($amountUsed + sizeof($peopleWithReductionCodeFromSession)) - $duplicate;
			return $amount;
	}	
		
		function getIdByCodeAndEventId($code,$eventId){
			return $this->field('id',array('code'=> $code, 'event_id' => $eventId));
		}
		
		
	}
