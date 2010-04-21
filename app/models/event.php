<?php

	Class Event extends AppModel {
		
		var $hasMany = "Registration"; 
		var $hasAndBelongsToMany = "Step";
			
	/*
	 * TODO use findById instead, where is this used
	 * Returns the event from DB based on Id
	 * @return array
	 */
	function getEventById($id){
		return $this->findById($id , array( 'recursive' => 0));
	}
		
	function getEvents(){
		$events = $this->find('all',array('fields' => array('id','name','confirmation_message','is_active'),'recursive' => 0));
		foreach ($events as &$event) {
			$event = $event['Event'];
		}
		return $events;
	}
	function findFirstActiveEvent() {
		$event = $this->find('first', array('conditions' => array('Event.is_active' => 1) , 'recursive' => 0));
		return $event;
	}
}
	