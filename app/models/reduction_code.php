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
		
		function getNumberOfPeopleByCode($code,$eventId){
			return $this->field('number_of_people', array(
					'code'=> $code ,
					'event_id' => $eventId
				));
		}
		
		function getNumberOfPeopleLeft($id, $reduction = 0) {
			$reductionCode = $this->findById($id);
			$numberOfPeople = $reductionCode['ReductionCode']['code'];
			
			$amountUsed = $this->getAmountUsed($reductionCode); 
			if (!is_numeric($reduction))
				$reduction = 0;
			$peopleLeft = $numberOfPeople - $amountUsed-$reduction;
			
			return $peopleLeft;
			
		}
		
		function getAmountUsed($reductionCodeCode) {
			$peopleWithReductionCode = $this->Person->find('all', array('conditions' => array('reduction_code_code' => $reductionCodeCode)));
			return sizeof($peopleWithReductionCode);
		}
		
		function codeExists($code, $eventId){
			if($this->field('code',array('code' => $code, 'event_id' => $eventId)))
				return true;
			else 
				return false;	
		}
		
		function getNumberOfPeopleWithCode ($id,$people){
			//if(!is_array($people)) 
			//	throw new Exception('People is not an array');
			debug($this->Person->find('all',array('conditions'=> array('id'=> $id),'recursive'=> -1)));	
			//debug(sizeOf($people));
			debug($people);
		}
		
		function getIdByCodeAndEventId($code,$eventId){
			return $this->field('id',array('code'=> $code, 'event_id' => $eventId));	
			
		}
		
	}
