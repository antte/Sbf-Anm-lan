<div class="grid_4" id="receipt_info">
	<div class="grid_full">
	<h2>Granskning</h2>
<?php if($this->requestAction('admins/checkAdminLoggedIn')): ?>
	<p>Du är nu i redigeringsläge för en bokning. För att ändra i någon uppgift, använd Redigera-länkarna under respektive del.</p>
	<p>Tänk på att inte gå ifrån sidan innan du har tryckt spara i det här läget. Om du inte gör det kommer inte ändringarna att sparas.</p>
	<p>Det räcker INTE att trycka på ändra i t.ex. sällskap eller kontaktuppgifter. Du bör inte heller lämna en sida utan att trycka ändra, då kommer det inte heller att sparas.</p>
<?php else: ?>
	<p>Var vänlig och kontrollera alla dina uppgifter innan du bekräftar din anmälan. För att ändra i någon uppgift, använd Redigera-länkarna under respektive del.</p>
	<p>Du kommer även att ha möjlighet att ändra i din order efter bekräftelse.</p>
<?php endif; ?>
	</div>
</div>