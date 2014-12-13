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
			<div id="header">
				<div class="row">
					<div class="col-md-6"><a href="/">PUKIS</a> user management</div>
					<div class="col-md-6"></div>
				</div>
			</div>
			<div>
				<?php echo $this->Session->flash(); ?>
			</div>
			<div id="content">
				<?php echo $this->fetch('content'); ?>
				
				<div id="sql-dump">
					<?php echo $this->element('sql_dump'); ?>
				</div>
			</div>
			<div id="footer">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6 text-right">
						Copyright &copy; KODEH!VE 2014
					</div>
				</div>
			</div>
			
			<!-- loader  -->
			<div id="loader">
				
			</div>
			
			<!-- modal  -->
			<div id="modal">

			</div>
			
			<!-- debug -->
			<?php if (!empty(Wmonou::$args)) { ?>
			<div style=\"padding:5px;background:#e1e1e1;\">
				<h5>Wmonou Debuger :</h5>
				<?php foreach (Wmonou::$args as $arg) { ?>
					<pre style=\"padding:10px;background:#cecece;\">
						<?php print_r($arg) ?>
					</pre>
				<?php } ?>
				</div>
			<?php } ?>
		</div>
	</body>
</html>