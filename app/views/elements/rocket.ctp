<?php 
$event = $this->requestAction("events");
debug($event);
$registration = $this->requestAction("registrations");
debug($registration);
$controller = $this->params['controller'];
debug($controller);
$action = $this->params['action'];
debug($action);
?>

<?php 
/*
 * raketen behöver veta:
 * vilka steps som finns
 * vilka steg har data
 * vilket är nuvarande steg (url:en)
 */
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
		<li class="<?php echo $stepStatus; ?>" >
			<?php echo $step['label'];?>
		</li>
	<?php endforeach;?>
</ol>