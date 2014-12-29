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
			<?php echo $this->element('Pukis/pukis_header', array(), array('plugin' => 'Pukis')); ?>

			<div id="content">
				<div class="pukis-admin-menu">
					<div class="menu col-md-2 col-xs-3">
						<!-- Menu -->
						<aside class="sidebar">
							<?php echo $this->Menu->createMenu($sidebar); ?>
						</aside>
					</div>

					<div class="frame col-md-10 col-md-offset-2 col-xs-9 col-xs-offset-3">
						<div class="body">
							<?php print $this->fetch('content'); ?>
						</div>
					</div>
				</div>
			</div>

			<?php echo $this->element('Pukis/pukis_footer', array(), array('plugin' => 'Pukis')); ?>

			<!-- loader  -->
			<div id="loader">

			</div>

			<!-- modal  -->
			<div id="modal">

			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {

				var request = new PUKISAPP.BEHAVIOR.PUKIS.ajax();

				$('#header a').click(function(e){
					e.preventDefault();
					request.ajaxRequest(this, this.href, $('#header').parent());
				});

				$('.sidebar a').not('.sidebar a.new').click(function(e){
					e.preventDefault();
					request.ajaxRequest(this, this.href, '.body');
				});

				$('.sidebar').metisMenu();

			});
		</script>

	</body>
</html>