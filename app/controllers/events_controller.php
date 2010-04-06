<?php
	class EventsController extends AppController {
		
		var $helpers = array('Html', 'Form', 'Javascript');
		
		/**
		 * Send array of all events in the database to the index view
		 */
		function index() {
			$this->set('events', $this->Event->find('all'));	
		}
		
		/**
		 * Get the event id and send event info to the view
		 * @param unknown_type $eventId
		 */
		function view($eventId = null) {
			if (!isset($eventId)) $this->redirect(array('action' => 'index'));
			if (is_numeric($eventId)) $this->set('event', $this->Event->findById($eventId));
			if (is_string($eventId)) $this->set('event', $this->Event->findByName($eventId));
		}

		/**
		 * Save the selected event in session and redirekt to next step
		 * @param $eventId
		 */
		function next($eventId) {
			$steps = array(
				'Person' => array(
					'current_step' => true,
					'label' => 'Sällskap',
				),
				'Registrator' => array(
					'current_step' => false,
					'label' => 'Kontaktuppgifter',
				),
				'Review' => array(
					'current_step' => false,
					'label' => 'Granska',
				),
				'Receipt'=> array(
					'current_step' => false,
					'label' => 'Kvitto',
				)
			);
			
			$this->Session->write('Registration.Registration.event_id', $eventId);
			$this->Session->write('Registration.Event.steps', $steps);
			$this->redirect(array('controller' => 'people', 'action' => 'create'));
			
			
		}
		
}
	
