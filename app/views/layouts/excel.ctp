<?php 
	$filename = $this->params['pass'][0].".xls";
	function setHeader($filename) {
        header("Pragma: public");
        header("Expires: 0");
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Type: application/force-download");
        header("Content-Type: application/download");;
        header("Content-Disposition: inline; filename=\"".$filename.".xls\"");
    }
	echo $content_for_layout;
	echo setHeader($filename);
?>