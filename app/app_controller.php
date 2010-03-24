<?php
	class AppController extends Controller {
		//var $components = array('Security'); TODO kolla hur funkar
		
		/**
		 * Push something into an array in session (couldn't find this functionality anywhere)
		 * please improve this by using an existing function ;)
		 * @param string $arrayName
		 * @param mixed $dataToPush
		 */
		function saveModelDataToSession($modelName, $dataToPush) {
			// Kan vara ide att hämta från någon konfigfil
			$arrayName = 'Registration';
			$array = $this->Session->read($arrayName);
			$array[$modelName] = $dataToPush[$modelName];
			$this->Session->write($arrayName, $array);
		}
		
	}