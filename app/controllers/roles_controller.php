<?php
	class RolesController extends AppController {
		
		function index() {
			if($this->params['requested']) {
				$rolesData = $this->Role->find('list');
				return $rolesData;
			} else {
				$this->redirect(array('controller' => 'events', 'action' => 'index'));
			}
		}
	}