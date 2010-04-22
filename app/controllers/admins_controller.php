<?php
App::import('Sanitize');

class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');
	var $layout = "admin";
	
	function beforeFilter() {
		$this->loadModel("Event");
		if ($this->Session->check('adminLoggedIn')) {
			$this->set('adminLoggedIn', 1);
		} else {
			if (!($this->params['action'] == 'login'))
				$this->redirect(array( 'controller' => 'admins' , 'action' => 'login' )); 
			$this->set('adminLoggedIn', 0);			 	
		}
	}

	/**
	 * login action for login view also processes login when POSTed
	 */
	function login(){
		if ($this->data['Admin']){
			//the user wants to log in
			if($this->Admin->valid($this->data['Admin']['username'], $this->data['Admin']['password'])) {
				$this->Session->write('adminLoggedIn', 1);
				$this->choseFirstActiveEvent();
			}
			$this->set('loginErrors', $this->Admin->loginErrors);
		}
	}
	
	function index() {
		//redurect me to the first active events bookings!!!
	}

	function events(){
		//if you're here you want to change event so we "deselect" the current event from session
		$this->Session->del('Event');
		
		$this->loadModel('Event');
		$this->set('events', $this->Event->getEvents());
	}
	
	function event($id){		
		$this->loadModel('Event');
		$event = $this->Event->find('first', array('conditions' => array('id' => $id) , 'recursive' => 0) );
		$this->set('event' , $event);
		$this->Session->write('Event',$event['Event']);
		//$this->set('event',$this->params)		
	}
	
	
	function logout() {
		//deletes the user session
		$this->Session->del('adminLoggedIn');
		$this->Session->setFlash("Du har nu loggat ut!", 'default', array('class' => 'loggedOut'));
		//when you have logged out you get redirected to login
		$this->redirect(array('controller' => 'admins' , 'action' => 'login'));

	}
	
	/**
	 * Made to be requested by the admin panel
	 * state becomes classes
	 * @return admin steps (event steps without review and receipt)
	 */
	function steps() {
		
		if(!isset($this->params['requested'])) return;
		
		//if we can't find eventId we wont be able to find steps
		if (!$this->Session->check('Event.id')) return;	
		$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		/**
		 * remove registration review and registration receipt from steps before returning
		 */
		foreach ($steps as &$step) {
			if ( 
				$step['controller'] == 'Registrations' && 
				( $step['action'] == 'review' || $step['action'] == 'receipt' ) 
			) {
				unset($step);
				continue;
			}
			
			// rename some steps for the admin view
			if( $step['controller'] == "People"){
				$step['label'] = "Anmälda";
				$step['action'] = 'index';
			}
				
			if( $step['controller'] == "Registrators")
				$step['label'] = "Bokningar";
				$step['action'] = 'index';
				
			
			$step['classes'] = $step['state'];
			unset($step['state']);
		}
		
		return $steps;
	
	}
	
	/**
	 * TODO remove on deploy
	 * @param $username
	 * @param $password
	 */
	function newAdmin($username, $password) {
		if( !(Configure::read('debug') >= 1) ) return;
		$admin['Admin']['username'] = $username;
		$admin['Admin']['password'] = md5($password);
		$this->Admin->save($admin);
	}
	
	function checkAdminLoggedIn() {	return $this->Session->check('adminLoggedIn'); }
	
	/**
	 * Action for a view that lists all registrations for the particular event the user has chosen
	 */
	function registrations() {
		//TODO check so that the admin has chosen an event here (like we have on our other actions)
		$eventId = $this->Session->read('Event.id');

		
		$this->loadModel('Event');
		$event = $this->Event->find('first', array('recursive' => 1) );
		unset($event['id']);
		unset($event['event_id']);
		$this->set( 'event', $event);
		debug($event);
		
		//$event = Set::sort($event, '{n}.Registration.created', 'modified');
		

		if ($this->params['pass'])
			$elementUrl = $this->params['pass'][0]. '/' .$this->params['pass'][1]; 
		else 
			$elementUrl = 'registratiors/index';
		$this->set('element' , $elementUrl);
	}
	
	/**
	 * Puts the event in session and redirects to registrations
	 */
	function choseEvent($id) {
		$this->requestAction('events/setEvent/'. $id);
		$this->redirect( array('action' => 'registrations') );
	}
	
	/**
	 * 
	 */
	private function choseFirstActiveEvent() {
		$event = $this->Event->findFirstActiveEvent();
		$this->choseEvent($event['Event']['id']);

	}
	
}

