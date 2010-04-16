<!DOCTYPE html>
<html>
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>  
	</title>
	<?php
		echo $html->meta('icon');

		//echo $html->css('cake.generic');
		
		echo $html->css('reset');
		echo $html->css('stickyfooter');
		echo $html->css('960');
		echo $html->css('text');
		echo $html->css('debug');
		echo $html->css(array('print'), 'stylesheet', array('media' =>  'print'));
		

		echo $html->css('firstblood');
		//TODO $javascript is a non-object???
		//echo $javascript->link('jquery.1.4.2-min', false);
	?>
	<!--[if lte IE 6]>
		<?php echo $html->css('ie'); ?>
	<![endif]-->
	
</head>
<body>
	<div id="wrap">
		<header>
			<div class="container_12">
			<?php if(Configure::read('debug') >= 1) echo $this->renderElement('debug');?>
			</div>
		</header>
		<div id="main" class="clearfix">
			<div class="container_12">
				<?php $session->flash(); ?>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
	</div>
	<footer>
		<div class="container_12">
			<?php
			 echo $cakeDebug; ?>
		</div>
		<?php echo $scripts_for_layout;?>
	</footer>
</body>
</html>