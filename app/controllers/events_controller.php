<?php
	class EventsController extends AppController {
		
		var $helpers = array('Html', 'Form', 'Javascript');
		
		function index() {
			$this->set('events', $this->Event->find('all'));
		}
		
		function view($eventId = null) {
			if (!isset($eventId)) {
				$this->redirect(array('action' => 'index'));
			}
			if (!is_numeric($eventId)) {
				$this->redirect(array('action' => 'index'));
			}
			$this->set('event', $this->Event->findById($eventId));
		}
	}