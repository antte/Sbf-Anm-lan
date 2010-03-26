<?php

	class AppModel extends Model {
		
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
		
	}