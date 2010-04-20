<?php
class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');
	var $layout = "admin";

	/**
	 * login action for login view also processes login when POSTed
	 */
	function login(){
		if ($this->data['Admin']){
			//the user wants to log in
			if($this->Admin->valid($this->data['Admin']['username'], $this->data['Admin']['password'])) {
				$this->Session->write('adminLoggedIn', 1);
				$this->redirect( array('action' => 'index') );
			}
			$this->set('loginErrors', $this->Admin->loginErrors);
		}
	}

	function index($id = null ){
		$this->loadModel('Event');
		// Logged in as admin do
		if ($this->Session->check('adminLoggedIn')){
			if ($id) {
				$this->redirect(array('controller'=>'admins' , 'action' => 'events' ,$id));
			}
		$this->set('events', $this->Event->getEvents());
			
		// Not logged in do
		} else {
			$this->redirect(array('controller' => 'admins' , 'action' => 'login'));		
		}
	}
	
	function event($id){		
		$this->loadModel('Event');
		$event = $this->Event->find('first', array('conditions' => array('id' => $id) , 'recursive' => 0) );
		$this->set('event' , $event);
		debug($this->Session->read());
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
	 * @return admin steps (event steps without review and receipt)
	 */
	function steps() {
		
		if(!isset($this->params['requested'])) return;
		
		if ($this->Session->check('Event.id'))
			$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		else
			return false;
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
	
}

