<div class="grid_12">
	<div class="grid_full">
		<h2 class="fourofour">Sidan finns inte!</h2>
	</div>
</div>

<div id="fourofour" class="grid_12">
	<div class="grid_full">
		<p>Det verkar som att du har följt en länk eller försökt öppna en sida som inte existerar.</p>
		<h3>Vad gör jag nu?</h3>
		<p><?php echo $html->link('Gå tillbaka till listan med evenemang', array('controller' => 'events', 'action' => 'index')); ?> du kan anmäla dig till, eller om du redan har genomfört en bokning kan du <?php echo $html->link('logga in för att ändra i den', array('controller' => 'registrations', 'action' => 'login')); ?>.</p>
		<p>Om du följt en felaktig länk kan du felanmäla det till <a href="mailto:support@sbf.se">support@sbf.se</a>.</p>
	</div>
</div>