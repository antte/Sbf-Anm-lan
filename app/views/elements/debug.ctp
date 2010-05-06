<?php if(Configure::read('debug') >= 1):?>
	<ul id="debug">
		<li style='background:pink;'>
		<?php echo $html->link('Put that cookie down!', array('controller' => 'registrations', 'action' => 'clearSessionAndRedirectToEvents')); ?>
		</li>
		<li style='top:30px;background:lightgreen;'>
		<?php echo $html->link('Put that cookie up!', array( 'controller' =>'registrations' , 'action' => 'populateSessionAndRedirectToNextUnfinished'));?>
		</li>
		<?php if ($this->requestAction('registrations/sendEmails')): ?>
			<li style='top:60px;background:green;'>
		<?php else: ?>
			<li style='top:60px;background:red;'>
		<?php endif; ?>
		<?php echo $html->link('sendingEmails', array( 'controller' =>'registrations' , 'action' => 'toggleSendEmails', $this->params['controller'], $this->params['action'] ), array('class' => 'sendingEmails')); ?>
		</li>
		<li style="margin-top: 100px; text-align: right;">
		<?php //debug( $this->requestAction('steps/debug'))?>
		</li>
	</ul>
<?php endif; ?>