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
		 */
		function getNumberOfPeopleLeft($id, $reduction = 0) {
			$amountUsed = $this->getNumberOfPeopleById($id); 
			if (is_numeric($reduction))
				$reduction = 0;
			
			
			
			$peopleLeft = $amountUsed - $reduction;
			return $peopleLeft;
			
			
		}
		
		function getNumberOfPeopleWithReductionCodeById($id) {
			$peopleWithReductionCode = $this->Person->find('all', array('conditions' => array('reduction_code_id' => $id)));
			//$peopleWithReductionCode = $this->Person->findByReductionCodeId();
			return sizeof($peopleWithReductionCode);
		}
		
		function codeExists($id){
			if($this->field('id',array('id' => $id)))
				return true;
			else 
				return false;	
		}
		
		function getNumberOfPeopleWithCode ($id,$people){
			//hämta antal personer med reducrtion_code.id ur DB 
			//räkna ut antal personer i arrayen dom har reduction_code_id = id
			$amountUsed = $this->getNumberOfPeopleWithReductionCodeById($id);
		
			$path = '/Person[reduction_code_id='. $id.']';
			$result	= Set::extract($path,$people);
			
			if (!is_numeric($people))
				$increase = 0;
			
				
				
			//debug($result);	
			$amount = $amountUsed;
			return $amount;
		}	
			
		
		function getIdByCodeAndEventId($code,$eventId){
			return $this->field('id',array('code'=> $code, 'event_id' => $eventId));	
			
		}
		
	}
