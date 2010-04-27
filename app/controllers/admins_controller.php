<?php
App::import('Sanitize');

class AdminsController extends AppController {

	var $helpers = array('html','form','javascript');
	var $layout = "admin";
	
	function beforeFilter() {
		
		$this->loadModel("Event");
		
		//you can't visit any admin pages if you arent logged in as admin, with some exceptions
		if (!$this->Session->check('adminLoggedIn')) {
			//if this action is not one of the permitted actions you are send to login
			if (!$this->actionPermittedWithoutLogin($this->params['action'])) {
				$this->redirect(array( 'controller' => 'admins' , 'action' => 'login' ));
			}
		}
		
	}

	/**
	 * login action for login view also processes login when POSTed
	 */
	function login(){
		if ($this->data['Admin']){
			//the user wants to log in
			if($this->Admin->valid($this->data['Admin']['username'], $this->data['Admin']['password'])) {
				$admin = $this->Admin->findByUsername($this->data['Admin']['username']);
				$this->Session->write('adminLoggedIn', $admin['Admin']['id']);
				$this->chooseFirstActiveEvent();
			}
			$this->set('loginErrors', $this->Admin->loginErrors);
		}
	}
	
	function events(){
		//if you're here we assume you want to change event so we "deselect" the current event from session
		$this->Session->del('Event');
		
		$this->set('events', $this->Event->getEvents());
	}
	
	function event($id){
		$event = $this->Event->find('first', array('conditions' => array('id' => $id) , 'recursive' => 0) );
		$this->set('event' , $event);
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
	function steps( $controller = null ) {
		$controller = Inflector::camelize($controller);
		if(!isset($this->params['requested'])) return;
		
		//if we can't find eventId we wont be able to find steps
		if (!$this->Session->check('Event.id')) return;	
		$steps = $this->requestAction('steps/getInitializedSteps/'. $this->Session->read('Event.id'));
		
		/**
		 * remove registration review and registration receipt from steps before returning
		 */
		$adminSteps = array();
		foreach ($steps as $key => $step) {
			if (!$step['admin_label']) {
				continue;
			}
			
			if ($step['controller'] == $controller){
				$adminSteps[$key]['classes'] = 'current';
			}
			else {
				$adminSteps[$key]['classes'] = $step['state'];
			}
			$adminSteps[$key]['admin_label'] = $step['admin_label'];
			$adminSteps[$key]['controller'] = $step['controller'];
			$adminSteps[$key]['action'] = $step['action'];
			$adminSteps[$key]['order'] = $step['order'];
			
		}
		return $adminSteps;
	
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
	
	function checkAdminLoggedIn() {	
		return $this->Session->check('adminLoggedIn'); 
	}
	
	/**
	 * Action for a view that lists all registrations for the particular event the user has chosen
	 */
	function eventindex() {
		$defaultElementAction='index';
		//TODO check so that the admin has chosen an event here (like we have on our other actions)
		$eventId = $this->Session->read('Event.id');

		//set event info to view
		$event = $this->Event->find('first', array('recursive' => 1) );
		unset($event['id']);
		unset($event['event_id']);
		$this->set( 'event', $event);
	
		
		if ($this->params['pass'])
			$elementUrl = $this->params['pass'][0] . '/' .  $defaultElementAction ; 
		else {
			$this->params['pass'][0]= 'registrators'; //default
			$elementUrl = 'registrators/' . $defaultElementAction;
		}
		$this->set('elementUrl' , $elementUrl);
	}
	
	/**
	 * Puts the event in session and redirects to registrations
	 * @param $id the id of an event
	 */
	function chooseEvent($id) {
		$this->requestAction('events/setEvent/'. $id);
		$this->redirect( array('action' => 'eventindex'));
	}
	
	/**
	 * 
	 */
	private function chooseFirstActiveEvent() {
		$event = $this->Event->findFirstActiveEvent();
		$this->chooseEvent($event['Event']['id']);

	}
	
	/**
	 * 
	 */
	function putRegistrationInSessionAndRedirect($registrationNumber) {
		
		$registration = $this->Event->Registration->findByNumber($registrationNumber);
		
		$this->Event->Registration->putRegistrationInSession($registration, $this->Session);
		
		//all steps up until review are set to previous so that redirectToNextUnfinished redirects to the right step
		$this->setPreviousStepsToPrevious('Registrations','review');
		
		$this->requestAction('steps/redirectToNextUnfinishedStep');
	}
	
	/**
	 * @return int current admins.id
	 */
	function getCurrentAdminId() {
		
		if(!isset($this->params['requested'])) return;
		
		return $this->Session->read('adminLoggedIn');
		
	}
	
	/**
	 * If the specified action is permitted to be visited wihtout login this function returns true
	 * @action string
	 */
	private function actionPermittedWithoutLogin($action) {
		
		if($action == 'login') return true;
		if($action == 'checkAdminLoggedIn') return true;
		
		return false;
		
	}
	
}

