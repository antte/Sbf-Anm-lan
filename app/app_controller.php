<?php
	class AppController extends Controller {
		//var $components = array('Security'); TODO kolla hur funkar
		
		/**
		 * Takes data from controllers and puts in in the sesssion so that we can save it later
		 * @param string $modelName to which name would you like to push (name should be the same as the model that will later be used to save the data)
		 * @param mixed $dataToPush this->data from the different controllers that contains the information that we'll later save
		 */
		function saveModelDataToSession($modelName, $dataToPush) {
			// Kan vara ide att hämta från någon konfigfil
			$arrayName = 'Registration';
			$array = $this->Session->read($arrayName);
			$array[$modelName] = $dataToPush[$modelName];
			$this->Session->write($arrayName, $array);
		}
		
		/**
		 * Push something into an array in session (couldn't find this functionality anywhere)
		 * please improve this by using an existing function ;)
		 * @param string $arrayName
		 * @param mixed $dataToPush
		 */
		function pushToSessionArray($arrayName, $dataToPush) {
			$array = $this->Session->read($arrayName);
			$array[] = $dataToPush;
			$this->Session-write($arrayName, $array);
		}
		
	}