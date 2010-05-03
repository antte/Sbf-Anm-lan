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
				'/People.first_name/'				=> 'Förnamn',
				'/People.last_name/'				=> 'Efternamn',
				'/People.role_id/'					=> 'Roll id',
				'/Event.name/'						=> 'Evenemangsnamn',
				'/Event.confirmation_message/'		=> 'Bekräftelsemeddelande',
				'/Event.price_per_person/'			=> 'Pris/person'
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