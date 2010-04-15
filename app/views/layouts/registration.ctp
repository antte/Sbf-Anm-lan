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
		echo $html->css('rocket');
		echo $html->css(array('print'), 'stylesheet', array('media' =>  'print'));
		echo $html->css('firstblood');
		echo $javascript->link('jquery.1.4.2-min');
		echo $javascript->link('rocket');
	?>
	<!--[if lte IE 6]>
		<?php echo $html->css('ie'); ?>
	<![endif]-->
	
</head>
<body>

	<div id="wrap">
		<header>
			<div class="container_12">
				<?php 
				if(Configure::read('debug') >= 1) {
					//put that cookie DOWN
					echo "<div id='cookie' style='position:absolute;top:0;right:0;background:pink;color:black;padding:2px;'>";
					echo $html->link('Put that cookie down!', array( 'controller' =>'registrations' , 'action' => 'clearSessionAndRedirectToEvents'));
					echo "</div>";
					
					//put that cookie UP
					echo "<div id='cookie' style='position:absolute;top:30px;right:0;background:pink;color:black;padding:2px;'>";
					echo $html->link('Put that cookie up!', array( 'controller' =>'registrations' , 'action' => 'populateSessionAndRedirectToNextUnfinished'));
					echo "</div>";
				}
				?>
			</div>
		</header>
		<div id="main" class="clearfix">
			<div class="container_12">
			
				<?php echo $this->renderElement('step'); ?>
			</div>
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