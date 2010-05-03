<?php 
	$filename = $this->params['pass'][0].".xls";
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
	header('Content-Disposition: attachment; filename=' . $filename);
	echo $content_for_layout;
?>