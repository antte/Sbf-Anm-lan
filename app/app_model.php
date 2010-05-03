<?php

	class AppModel extends Model {
		 var $actsAs = array('Containable');
		
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
			
			//This is for code readability - Search becomes replace
			$search_replace = array(
				'/Registration.number/' 			=> 'Bokningsnummer', 
				'/Registration.modified_admin_id/' 	=> 'Admin som ändrat',
				'/Registration.modified_admin/' 	=> 'Ändrad av admin', 
				'/Registration.modified/' 			=> 'Ändrad av bokaren', 
				'/Registrator.first_name/' 			=> 'Förnamn', 
				'/Registrator.last_name/' 			=> 'Efternamn', 
				'/Registrator.email/' 				=> 'Epost', 
				'/Registrator.phone/' 				=> 'Telefon'
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
			return $this->find('all', array('recursive' => -1));
		}
			
	}