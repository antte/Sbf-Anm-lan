<?php
class EventsController extends AppController {

	var $helpers = array('Html', 'Form', 'Javascript');

	/**
	 * Get an array of all the events in the database and returns it to the index view
	 * @return array
	 */
	function index() {
		if(isset($this->params['requested'])) {
			//the requester wants either ALL events or the ONE event the user is making a registration for right now

			if ($this->Session->read('Event.id')) {
					
				$event = $this->Event->findById($this->Session->read('Event.id'));
				unset($event['Registration']);
				return $event;
			}

			return $this->Event->find('all');
		}
			
		$this->set('events', $this->Event->find('all'));
	}

	/**
	 * Get a single event with info to the view and write it to the session
	 * @param unknown_type $eventId
	 */
	function view($eventId = null) {
		
		//if we dont have an id for an event, redirect to the list of all the events
		if (!isset($eventId)) $this->redirect(array('action' => 'index'));
		
		$this->set('event', $this->Event->findById($eventId));
		$event = $this->Event->findById($eventId);
		unset($event['Registration']);	
		unset($event['Step']);	
		$this->Session->write('Event', $event['Event']);
		$this->Session->write('Registration.Registration.event_id', $eventId);
		$this->requestAction('Steps/initializeSteps/'. $eventId);
		//TODO trassel med eventid som tillåts vara namnet på eventet, borde fixa en bättre lösning än denna?
		$eventId = $this->Event->find('first', array('conditions' => array('name' => $eventId)));
		$eventId = $eventId['Event']['id'];
	}


}
