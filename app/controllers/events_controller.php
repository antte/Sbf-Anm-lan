<?php
class EventsController extends AppController {

	var $helpers = array('Html', 'Form', 'Javascript');
	var $altName = 'Evenemang';
	var $altDescribe = 'Hanterar olika tillställningar';
	/**
	 * Get an array of all the events in the database and returns it to the index view
	 * @return array
	 */
	function index($eventId = null) {
		if(isset($this->params['requested'])) {

			//If event info is allready populated to Session use that event id 

			
			//If event info is already populated to Session use that event id 
			if ($this->Session->check('Event.id')) {					
				$event = $this->Event->findById($this->Session->read('Event.id'));
				$event = $event['Event'];
				return $event;
			}
			
			//if event info is populated like this we still want to return it
			if ($this->Session->check('Event.Event.id')) {					
				$event = $this->Event->findById($this->Session->read('Event.Event.id'));
				$event = $event['Event'];
				return $event;
			}
			
			//If no event is populated in Session get info with $id
			if (isset($id)){
				$event = $this->Event->findById($eventId);
				$event = $event['Event'];
				return $event;
			}
			
			
			//If not specified event id return all Events
			return $this->Event->find('all');
			
		} else {
			
		$this->set('events', $this->Event->find('all',array('recursive' => 0)));
		}
	}

	/**
	 * Get a single event with info to the view and write it to the session
	 * @param unknown_type $eventId
	 */
	function view($eventId = null) {
		
		//if we dont have an id for an event, redirect to the list of all the events
		if (!isset($eventId)) $this->redirect(array('action' => 'index'));
		if (!is_numeric($eventId)) $this->redirect(array('action' => 'index'));
		
		$event = $this->Event->findById($eventId);
		$this->set('event', $event);
		unset($event['Registration']);	
		unset($event['Step']);	
		$this->Session->write('Event', $event['Event']);
		$this->Session->write('Registration.Registration.event_id', $eventId);
		$this->requestAction('Steps/initializeSteps/'. $eventId);
	}

	function setEvent($id){
		if (isset($this->params['requested'])) {
			$event = $this->Event->getEventById($id);
			$this->Session->write('Event' , $event['Event'] );
		}
	}
	
	function getEvents(){
		if (isset($this->params['requested'])) {
			return $this->Event->getEvents();
		}
	}
	
	function getBankgiroNumber() {
		$eventId = $this->Session->read('Event.id');
		return $this->Event->field('bank_giro', array('id' => $eventId));
	}
}
