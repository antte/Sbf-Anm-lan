<?php 
$steps = $this->requestAction("steps");
/*vi låstas få data här TODO ta bort när implementation är klar*/
/*
$steps = array(
	'hej' => array(
		'label' 		=> 'Sällskap',
		'state' 		=> 'previous',
		'controller' 	=> 'people',
		'action' 		=> 'create'
	),
	'nisse' => array(
		'label' 		=> 'Kontaktuppgifter',
		'state' 		=> 'current',
		'controller' 	=> 'registrators',
		'action' 		=> 'create'
	),
	'nej' => array(
		'label' 		=> 'Granska & Bekräfta',
		'state' 		=> 'coming',
		'controller' 	=> 'registrations',
		'action' 		=> 'review'
	),
	'tjej' => array(
		'label' 		=> 'Kvitto',
		'state' 		=> 'coming',
		'controller' 	=> 'registrations',
		'action' 		=> 'receipt'
	)
);*/
?>

<ol id="rocket" class="grid_full">
	<?php $i = 0;?>
	<?php foreach($steps as $step): ?>
		<li class="<?php echo $step['state'];
			if($i === 0) {
				echo " first";
			} else if ($i === (sizeof($steps) -1) ){
				echo " last";
			}
			?>">
			<span class="leftArrow"></span>
			<?php if (!preg_match('/^coming/', $step['state'])){
				echo $html->link($step['label'], array('controller' => $step['controller'], 'action' => $step['action']));
			} else { 
				echo '<span class="expander">';
				echo $step['label'];
				echo '</span>'; 
			}?>
		</li>
		<?php $i++;?>
	<?php endforeach; ?>
</ol>