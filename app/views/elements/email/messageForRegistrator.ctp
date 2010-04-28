<?php if($message = $this->requestAction('registrations/getMessageForRegistrator')): ?>
	<p>
		<?php echo $message?>
	</p>
<?php endif; ?>