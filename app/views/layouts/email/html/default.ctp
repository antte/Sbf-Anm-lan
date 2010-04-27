<!DOCTYPE html>
<html>
	<head>
	
	</head>
	<body>
		<h1>Bilsportförbundet </h1>
		<h2>Kvitto för bokning</h2>
		<p>
			Du kan 
			<?php echo $html->link('logga in', array('controller' => 'registrations', 'action' => 'login'));?>
			med ditt bokningsnummer och email för att göra ändringar i din bokning.
		</p>
		<?php echo ($this->requestAction('admins/checkAdminLoggedIn'))? $this->renderElement('email/messageForRegistrator') : '' ?>
		<?php // we dont want this / echo $this->renderElement('event');?>
		<?php echo $this->renderElement('registration');?>
		<?php echo $this->renderElement('person');?>
		<?php echo $this->renderElement('registrator');?>
	</body>
</html>