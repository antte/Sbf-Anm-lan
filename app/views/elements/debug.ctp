<?php if(Configure::read('debug') >= 1):?>
	<ul id="debug">
		<li style='background:pink;'>
		<?php echo $html->link('Put that cookie down!', array('controller' => 'registrations', 'action' => 'clearSessionAndRedirectToEvents')); ?>
		</li>
		<li style='top:30px;background:lightgreen;'>
		<?php echo $html->link('Put that cookie up!', array( 'controller' =>'registrations' , 'action' => 'populateSessionAndRedirectToNextUnfinished'));?>
		</li>
		<li style='top:60px;background:lightblue;'>
		<?php echo $html->link('TOGGLE sendEmails', array( 'controller' =>'registrations' , 'action' => 'toggleSendEmails'));?>
		</li>
	</ul>
<?php endif;?>