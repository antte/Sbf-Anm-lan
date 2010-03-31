<?php

	App::import('Sanitize');
	
	class AppController extends Controller {
		
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
		 * 
		 */
		function getRegistration() {
			/*
			 * if a registration has been made recently we return it
			 * we need to take into account that this action can be requested both before and after a registration has been saved
			 */
			if ($this->Session->read('Registration')) { 
				// if Registration exists the registration hasn't been saved yet and the user is reviewing his registration
				return $this->Session->read('Registration');
			} else if ($this->Session->read('registrationId')) {
				// registrationId is set when saving the registration so we take that as indication its saved already
				$this->loadModel('Registration');
				return $this->Registration->findById($this->Session->read('registrationId'));
			} else {
				//the user isn't making a registration so we send the requester all registrations
				return $this->Registration->find('all');
			}
		}
	}