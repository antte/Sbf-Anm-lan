<?php $registration = $this->requestAction('registrations/index');?>

<?php if ( $registration['Registration']['modified_admin']):?>
	<?php $adminUsername = $this->requestAction('admins/getAdminUsernameById/'. $registration['Registration']['modified_admin_id']); ?>
<?php endif; ?>

<?php $event = $this->requestAction('events/index/'. $registration['Registration']['event_id']);?>

<div id="booking_nr" class="grid_8">
	<div class="grid_full">
	  	<h2><?php echo $event['name'];?></h2>
	  	
		<?php if(isset($registration['Registration']['number'])):?>
			<p class="booking_nr">Bokningsnummer: <?php echo $registration['Registration']['number']?></p>
		<?php endif; ?>
		
		<?php if( isset($registration['Registration']['created']) ):?>
			<p class="datetime">Skapad: <?php echo $registration['Registration']['created']?></p>
		<?php endif; ?>
		
		<?php if( isset($registration['Registration']['created']) && isset($registration['Registration']['modified']) ):?>
			<?php if ( $registration['Registration']['created'] != $registration['Registration']['modified'] ):?>
				<p class="datetime">Senast ändrad: <?php echo $registration['Registration']['modified']?></p>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if ( isset($registration['Registration']['modified_admin'])):?>
			<p class="datetime">Senast ändrad av SBF: <?php echo $registration['Registration']['modified_admin'] . '<br /> Referens: ' . $adminUsername; ?></p>
		<?php endif; ?>
		
	</div>
</div>