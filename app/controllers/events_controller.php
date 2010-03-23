<?php
	class EventsController extends AppController {
		
		var $helpers = array('Html', 'Form', 'Javascript');
		
		function index() {
			$this->set('events', $this->Event->find('all'));
		}
		
		function view($eventId = null) {
			if (!isset($eventId)) $this->redirect(array('action' => 'index'));
			if (is_numeric($eventId)) $this->set('event', $this->Event->findById($eventId));
			if (is_string($eventId)) $this->set('event', $this->Event->findByName($eventId));
		}
		
		function next($eventId) {
			$this->Session->write('eventId', $eventId);
			$this->redirect(array('controller' => 'people', 'action' => 'create'));
		}
	}