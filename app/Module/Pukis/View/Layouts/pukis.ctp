<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?> - <?php echo __d('pukis', 'Pukis'); ?></title>
		<?php
			echo $this->Html->meta('favicon.ico', '/Pukis/favicon.ico', array('type' => 'icon'));
			echo $this->Html->meta('description', 'Pukis - A CakePHP ajax user management dashboard');
			echo $this->Html->meta(array('name' => 'keyword', 'content' => 'pukis, Pukis, cms, CMS, ajax, user management, cakephp'));
			echo $this->Html->meta(array('name' => 'author', 'content' => 'Yusuf Widiyatmono'));
			echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex'));

			echo $this->Html->css($style);
			echo $this->Html->script($script);

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div id="wrapper">
			<?php print $this->fetch('content'); ?>

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