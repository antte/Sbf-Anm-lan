<?php

	Class ReductionCode extends AppModel {
		
		var $exportAllowed = false;
		var $altName = 'Rabatter';
		var $hasMany = array(
			"Person"
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
		
	}
