<?php 
	echo $javascript->link('jquery.validate');
	echo $javascript->link('jq.form.conf/jq.validate.codes');
?>

<div class="grid_12">
	<div class="grid_full">
		<h2>Mata i din bokningskod och antal personer den gäller</h2>
	</div>
		<div id="addCode">
			<div class="inner_push">
				<?php echo $this->element('reduction_codes/create');?>
			</div>
		</div>
		<div id="viewCode">
			<div class="inner_push">
				<?php echo $this->element('reduction_codes/view')?>
			</div>
		</div>
</div>
