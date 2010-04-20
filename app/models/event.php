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
		
	function getEvents(){
		$events = $this->find('all',array('fields' => array('id','name','confirmation_message','is_active'),'recursive' => 0));
		foreach ($events as &$event) {
			$event = $event['Event'];
		}
		return $events;
	}
	function getEvent($id){
		return $this->field('id',$id);
	}	
}
	