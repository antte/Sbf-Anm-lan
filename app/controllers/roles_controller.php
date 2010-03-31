<?php
	class RolesController extends AppController {
		
		function index() {
			if($this->params['requested']) {
				$rolesData = $this->Role->find('all', array('conditions' => array('fields' => 'Role.name')));
				return $rolesData['Role'];
			} else {
				$this->redirect(array('controller' => 'events', 'action' => 'index'));
			}
		}
	}