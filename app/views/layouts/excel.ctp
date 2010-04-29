<?php 
	$filename = $this->params['pass'][0].".xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=' . $filename);
	echo $this->renderElement('excel');
?>