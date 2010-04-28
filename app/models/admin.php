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