<?php

	class AppModel extends Model {
		var $actsAs = array('Containable');
		var $exportAllowed = false;
		 
		function isExportAllowed() { return $this->exportAllowed; }
		
		/**
		 * Validates an array with multiple sets of data
		 * @param $array
		 * @return $status
		 */
		function validatesMultiple($array) {
			$status = array();
			foreach($array as $modelName => $dataSets) {
				foreach($dataSets as $dataSet) {
					$data[$modelName] = $dataSet;
					$this->set($data);
					$this->validates();
					if(!empty($this->validationErrors)) $status[] = $this->validationErrors;
				}
			}
			return $status;
		}
			
		/**
		 * translates database field names to human readable names in swedish
		 * NOTE: only works with registrator and registration fieldnames for now
		 * @fieldNames array of strings to translate
		 * @return array of strings with translated field names
		 */
		function translateFieldNames($fieldNames) {
			
			$this->addModelToFieldNames($fieldNames);
			
			//This is for code readability - Search becomes replace
			//!OBS! the order in this array is not arbitrary!
			$search_replace = array(
				'/Registration.number/' 			=> 'Bokningsnummer', 
				'/Registration.created/' 			=> 'Skapad',
				'/Registration.modified_admin_id/' 	=> 'Admin som ändrat',
				'/Registration.modified_admin/' 	=> 'Ändrad av admin', 
				'/Registration.modified/' 			=> 'Ändrad av bokaren', 
			
				'/Registrator.first_name/' 			=> 'Bokarens förnamn', 
				'/Registrator.last_name/' 			=> 'Bokarens efternamn', 
				'/Registrator.email/' 				=> 'Epost', 
				'/Registrator.phone/' 				=> 'Telefon',
				'/Registrator.c_o/' 				=> 'C/O',
				'/Registrator.street_address/'		=> 'Gatuaddress',
				'/Registrator.city/'				=> 'Stad',
				'/Registrator.postal_code/'			=> 'Postkod',
				'/Registrator.extra_information/'	=> 'Övrigt',
			
				'/Person.first_name/'				=> 'Förnamn',
				'/Person.last_name/'				=> 'Efternamn',
				'/Person.role_id/'					=> 'Roll id',
				'/Person.reduction_code_id/'		=> 'Rabattkod id',
			
				'/Event.name/'						=> 'Evenemangsnamn',
				'/Event.confirmation_message/'		=> 'Bekräftelsemeddelande',
				'/Event.price_per_person/'			=> 'Pris/person',
			
				'/ReductionCode.code/'				=> 'Rabattkod',
				'/ReductionCode.number_of_people/'	=> 'Antal personer'
			);
			
			$search = array();
			$replace = array();
			
			//this is to make the readable code into something that preg_replace understands 
			foreach($search_replace as $s => $r) {
				$search[] = $s;
				$replace[] = $r;
			}
			
			return preg_replace($search, $replace, $fieldNames);
			
		}
		
		/**
		 * Generall function meant to be overloaded in models
		 * Its important that this function returns a numerically indexed array
		 * containing model name which is an array containing fieldNames and values
		 * or results may vary :)
		 */
		function getExportDump() {
			if(isset($this->exportFields)) {
				//only return fields specified				
				return $this->find('all', array('recursive' => -1, 'fields' => $exportFields));
			} else {
				//this model doesnt have exportFields so we return it all
				return $this->find('all', array('recursive' => -1));
			}
		}
		
		/**
		 * Takes model field names such as Registration.number
		 * into table field names such as registrations.number
		 */
		function modelFieldNamesToTableFieldNames($modelFieldNames) {
			
			foreach ($modelFieldNames as $i => &$modelFieldName) {
				$modelFieldName = explode('.', $modelFieldName);
				$modelFieldName[0] = Inflector::tableize($modelFieldName[0]);
				$modelFieldName = implode('.', $modelFieldName);
			}
			
			return $modelFieldNames;
		}
	
		function getAltName(){
			return $this->altName;
		}
		
		/**
		 * 
		 * @param array $array
		 * @param string $value
		 */
		function unsetArrayKeyByValue($array, $value) {
			unset($array[array_search($value , $array)]);
			return $array;
		}
		
		function getFieldNames() {
			
			$fieldNames = array();
			
			foreach($this->_schema as $fieldName => $notUsed) {
				$fieldNames[] = $fieldName;
			}
			
			return $fieldNames;
			
		}
		
		/**
		 * 
		 * @param $fieldNames array of strings
		 */
		function removeUnsetFields($fieldNames) {
			if(!isset($this->unsetFields)) return $fieldNames;
			
			//This makes them uniform atleast, so that they can be compared
			$fieldNames = $this->addModelToFieldNames($fieldNames);
			$unsetFields = $this->addModelToFieldNames($this->unsetFields);
			
			foreach( $fieldNames as $i => $fieldName) {
				foreach( $unsetFields as $unsetField) {
					if($fieldName == $unsetField) {
						unset($fieldNames[$i]);
					}
				}
			}
			
			return $fieldNames;
			
		}
		
		/**
		 * 
		 * @param $array numerically indexed array of model X with index => fieldnames => values inside it
		 */
		function removeUnsetFieldsFromMultiple($array) {
			
			foreach($array as $i => $dataSet) {
				foreach($dataSet as $fieldName => $unused) {
					foreach($this->unsetFields as $unsetField) {
						if($unsetField == $fieldName)
							unset($array[$i][$fieldName]);
					}
				}
			}
			
			return $array;
			
		}
		
		/**
		 * if fieldName doesnt have model infront of it add the calling model
		 * @param $fieldNames
		 */
		function addModelToFieldNames($fieldNames) {
			foreach($fieldNames as &$fieldName) {
				if(strstr($fieldName, '.')) {
					continue;
				} else {
					$fieldName = $this->name .".". $fieldName;
				}
			}
			return $fieldNames;
		}
		
	}