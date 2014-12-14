<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?> - <?php echo __d('pukis', 'Pukis'); ?></title>
		<?php
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
				<?php echo $this->Session->flash(); ?>
			 
				<?php print $this->fetch('content'); ?>
				
				<?php echo $this->element('sql_dump'); ?>			
			</div>
			
			<div  id="footer">
				Footer
			</div>
			
			<!-- loader  -->
			<div class="loader">
				
			</div>
			
			<!-- modal  -->
			<div class="modal">

			</div>
		</div>
	</body>
</html>

