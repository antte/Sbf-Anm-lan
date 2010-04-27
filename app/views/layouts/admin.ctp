<!DOCTYPE html>
<html>
<head>
	<?php echo $html->charset(); ?>
	<title>
		Svenska bilsportförbundet -
		<?php echo $title_for_layout; ?>  
	</title>
	<?php
		echo $html->meta('icon');

		//echo $html->css('cake.generic');
		
		echo $html->css('reset');
		echo $html->css('stickyfooter');
		echo $html->css('960');
		echo $html->css('text');
		echo $html->css(array('print'), 'stylesheet', array('media' =>  'print'));
		echo $html->css('firstblood');
		echo $html->css('debug');
		echo $html->css('adminPanel');
		echo $html->css('dataTable');
		echo $html->css('admin');
		echo $html->css('login');
		
		echo $javascript->link('jquery.1.4.2-min');
		echo $javascript->link('jquery.dataTables.min');
		echo $javascript->link('adminSearch');
		echo $javascript->link('highlightInputField');
		
	?>
	<!--[if lte IE 6]>
		<?php echo $html->css('ie'); ?>
	<![endif]-->
	
</head>
<body class="admin">

	<div id="wrap">
		<header>
			<div class="container_12">
				<?php if(Configure::read('debug') >= 1) echo $this->renderElement('debug'); ?>
			</div>
		</header>
		<div id="main" class="clearfix">
			
			
			<div class="container_12">
				 
				<?php echo ( $this->requestAction('admins/checkAdminLoggedIn') && !($this->params['action'] == "login") ) ? $this->renderElement('adminPanel') : ''; ?>
				<?php $session->flash(); ?>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
	</div>
	<footer>
		<div class="container_12">
			<?php echo $cakeDebug; ?>
		</div>
		<?php echo $scripts_for_layout;?>
	</footer>
</body>
</html>