<?php
class EventsController extends AppController {

	var $helpers = array('Html', 'Form', 'Javascript');

	/**
	 * Send array of all events in the database to the index view
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
	 * Get the event id and send event info to the view
	 * @param unknown_type $eventId
	 */
	function view($eventId = null) {
		if (!isset($eventId)) $this->redirect(array('action' => 'index'));
			
		//TODO delete the rows because we only want to select an event by id, not name
		if (is_numeric($eventId)) $this->set('event', $this->Event->findById($eventId));
		if (is_string($eventId)) $this->set('event', $this->Event->findByName($eventId));
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
			
			
		//$this->Session->write('Registration.Registration.event_id', $eventId);
			
		//$this->redirect(array('controller' => 'people', 'action' => 'create'));
	}

	/**
	 * Save the selected event in session and redirect to next step
	 * @param $eventId
	 */


}
