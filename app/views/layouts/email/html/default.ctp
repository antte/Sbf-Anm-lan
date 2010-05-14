<!DOCTYPE html>
<html>
	<head>
	
	</head>
	<body>
		<h1>Bilsportförbundet </h1>
		<h2>Faktura</h2>
		<p>
			Du kan 
			<?php echo $html->link('logga in', array('controller' => 'registrations', 'action' => 'login'));?>
			med ditt bokningsnummer och email för att göra ändringar i din bokning. Du kommer då få en ny faktura skickad till dig
			
		</p>
		<?php echo ($this->requestAction('admins/checkAdminLoggedIn'))? $this->element('email/messageForRegistrator') : '' ?>
		<?php echo $this->element('registration');?>
		<?php echo $this->element('registrator');?>
		<?php echo $this->element('item');?>
		<?php echo $this->element('invoice');?>
	</body>
</html>