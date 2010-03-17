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
		

		echo $scripts_for_layout;
		echo $html->css('firstblood');
	?>
</head>
<body>
	<div id="wrap">
		<header>
			<div class="container_12">
				<h1>Svenska bilsportsförbundet</h1>
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
			<?php echo $cakeDebug; ?>
		</div>

	</footer>
</body>
</html>