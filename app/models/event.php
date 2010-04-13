<?php

	Class Event extends AppModel {
		
		var $hasMany = "Registration"; 
		var $hasAndBelongsToMany = "Step";
			
	/*
	 * Returns the event from DB based on Id
	 * @return array
	 */
	function getEventById($id = null){
			return $this->findById($id);
	}
		
		
}
	