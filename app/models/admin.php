<?php
App::import('Santize');

class Admin extends AppModel {

	var $loginErrors = array();

	/**
	 * Checks to see if username and password is a valid admin
	 * @param mixed $username
	 * @param mixed $password
	 */
	function valid($username, $password) {
			
		//delete old errors
		$loginErrors = array();
			
		//findBy automatically Sanitizes so i omited that
		$admin = $this->findByUsername($username);
			
		if($admin['Admin']['password'] == md5($password))
		return true;
			
		//just feels right to have a default return of false
		$loginErrors[] = 'Fel användarnamn eller lösenord';
		return false;
			
<<<<<<< HEAD
		}
	/*function resendConfirmEmail($event,$registrator){
		if($this->Session->read('dontSendEmails')) return;
		$this->Email->smtpOptions = array(
			'port'			=> '25', 
			'timeout'		=> '30',
			'host' 			=> 'localhost'
		);
		
		$this->Email->delivery 	= 'smtp';
		
		$this->Email->from		= 'noreply@sbf.se';
		$this->Email->to		= "{$registrator['first_name']} {$registrator['last_name']} <{$registrator['email']}>";
		$this->Email->bcc		= "it sbf <it@sbf.se>";
		$this->Email->replyTo	= 'it@sbf.se';
		
		$event = $this->Session->read('Event');
		$this->Email->subject	= "Kvitto för din anmälan till {$event['name']}";
		$this->Email->template	= 'default';
		$this->Email->sendAs	= 'both'; //both text and html
		$this->Email->send();
	}*/
		
	}
=======
	}
	
	/*
	 * Fetches admin username from database
	 * @param int $adminID
	 * @return mixed $username
	 */
	function getAdminUsernameFromId($adminId) {
		$username = $this->findById($adminId, array('fields' => array('username')));
		return $username;
	}


}
>>>>>>> d4b67d368db3e94f6e244d9a8832af02cf2e522c
