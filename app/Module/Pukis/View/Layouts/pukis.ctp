<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?> - <?php echo __d('pukis', 'Pukis'); ?></title>
		<?php
			echo $this->Html->meta('favicon.ico', '/Pukis/favicon.ico', array('type' => 'icon'));
			
			echo $this->Html->css($style);
			echo $this->Html->script($script);
	
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div id="wrapper">
		
			<div  id="header">
				Pukis
			</div>
					
			<div id="content">	 
				<?php print $this->fetch('content'); ?>
			</div>
			
			<div  id="footer">
				Footer
			</div>
			
			<!-- loader  -->
			<div id="loader">
				
			</div>
			
			<!-- modal  -->
			<div id="modal"aria-hidden="true">
			  	
			</div>
			
		</div>
		
		<?php echo $this->fetch('scriptBottom'); ?>
		
	</body>
</html>

