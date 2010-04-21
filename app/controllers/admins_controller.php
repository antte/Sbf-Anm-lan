<?php
App::import('Sanitize');

class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');
	var $layout = "admin";
	
	
	function __constructor() {
		parent::__constructor();
		$this->loadModel('Event');		
	}
	
	function beforeFilter() {
		if ($this->Session->check('adminLoggedIn')) 
			
			$this->set('adminLoggedIn', 1);
		else {
			if (!$this->params['action'] == 'login')
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
				$this->loadModel('Event');	
				$event = $this->Event->findFirstActiveEvent();
				$this->Session->write('Event', $event['Event']);
				//debug($event);
				$this->redirect( array('action' => 'registrations') );
			}
			$this->set('loginErrors', $this->Admin->loginErrors);
		}
	}
	
	function index() {
		//redurect me to the first active events bookings!!!
	}

	function events(){ //removed $id from arguments and everything broked, fix me!
		$this->loadModel('Event');		
		if ($this->Session->check('Event.id')) {
			$this->redirect(array('controller'=>'admins' , 'action' => 'event' ,$this->Session->read('Event.id')));
		}
		$this->set('events', $this->Event->getEvents());
		//redirect to next active events bookings
	}
	
	function event($id){		
		$this->loadModel('Event');
		$event = $this->Event->find('first', array('conditions' => array('id' => $id) , 'recursive' => 0) );
		$this->set('event' , $event);
		debug($event);
		$this->Session->write('Event',$event['Event']);
		//$this->set('event',$this->params)		
	}
	
	
	function logout() {
		//deletes the user session
		$this->Session->del('adminLoggedIn');
		$this->Session->setFlash("Du har nu loggat ut!");
		//when you have logged out you get redirected to login
		$this->redirect(array('controller' => 'Admin' , 'action' => 'login'));

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
			if ( $step['controller'] == 'Registrations' && 
			( $step['action'] == 'review' || $step['action'] == 'receipt' ) ) {
				unset($step);
				continue;
			}
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
		
		$this->set( 'event', $this->Event->find('first', array('recursive' => 1) ) );
		
	}
	
}

