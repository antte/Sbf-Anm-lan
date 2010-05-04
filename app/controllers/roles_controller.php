<?php
	class RolesController extends AppController {
	var $altName = 'Roller';
	var $altDescribe = 'Roll som person kan ha';
		
		/*
		 * Fetches a list of all the roles stored in the database
		 * @return array list of roles
		 */
		function index() {
			if($this->params['requested']) {
				$rolesData = $this->Role->find('list');
				return $rolesData;
			} else {
				$this->redirect(array('controller' => 'events', 'action' => 'index'));
			}
		}
	}