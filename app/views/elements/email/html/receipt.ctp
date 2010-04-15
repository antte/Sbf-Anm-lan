<h1>Bilsportförbundet </h1>
<h2>Kvitto för bokning</h2>
<p>
	Du kan 
	<?php $html->link('logga in', array('controller' => 'registrations', 'action' => 'login'));?>
	med ditt bokningsnummer och email för att göra ändringar i din bokning.
</p>
<?php echo $this->renderElement('registration')?>
<?php echo $this->renderElement('person')?>
<?php echo $this->renderElement('registrator')?>