<?php $event = $this->requestAction('Registrations/getEvent');?>

<?php 
//while its being implemented i pretend to get steps
/*$registration['Event']['steps'] = array(
	'People' => array(
		'label' => 'Sällskap',
		'current_step' => false
	),
	'Registrator' => array(
		'label' => 'Kontaktuppgifter',
		'current_step' => true
	),
	'Review' => array(
		'label' => 'Granska',
		'current_step' => false
	),
	'Receipt' => array(
		'label' => 'Bekräfta',
		'current_step' => false
	)
);*/
$currentStepFound = false;
?>

<ol id="rocket" class="grid_full">
	<?php foreach($event['steps'] as $step):?>
		<?php 
		//stepStatus can be current previous or coming
		if ($step['current_step']) {
			$currentStepFound = true;
			$stepStatus = "current";
		} else {
			if($currentStepFound) {
				$stepStatus = "coming";
			} else {
				$stepStatus = "previous";
			}
		}
		
		?>
		<li class="<?php echo $stepStatus; ?> grid_3" >
			<?php echo $step['label'];?>
		</li>
	<?php endforeach;?>
</ol>