<?php

	Class ReductionCode extends AppModel {
		
		var $exportAllowed = false;
		var $altName = 'Rabatter';
		var $hasMany = array(
			'Person'
		);
		var $belongsTo = array(
			'Event'
		);
		var $unsetFields= array(
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
		
		/**
		 * return array of all the required fields for reduction codes
		 */
		function getRequiredFields() {
			
			$requiredFields = array();
			$isRequired = false;
			
			foreach ($this->_schema as $fieldName => $metaDataTypes) {
				
				foreach($metaDataTypes as $metaDataType => $metaDataValue) {
					if($metaDataType == 'null') {
						//check if this field can be null (its not required)
						$isRequired = !$metaDataValue;
					} 
				}
				
				// dont add it to requiredFields if its not required
				if(!$isRequired) continue;
				
				// dont add it to requiredFields if its id (because its not something the user needs to type in)
				if($fieldName === 'id') continue;
				
				$requiredFields[] = $fieldName;	
						
			}
			
			return $requiredFields;
			
		}
		/*
		 * 
		 * @return a selection of colums from a event 
		 */
		function listReductionCodesByEventId($eventId){
			$reductionCodes = $this->find('all' ,array ('conditions' => array('event_id'=> $eventId),'recursive'=> -1 ));
			foreach ($reductionCodes as $i => $reductionCode){
				foreach ($this->unsetFields as $unsetField) {
					unset($reductionCodes[$i]['ReductionCode'][$unsetField]);
				
				}
			}
			
			return $reductionCodes; 
		}
	}
