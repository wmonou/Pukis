<div>
	<div class="col-md-12">	
		<?php echo $this->Session->flash(); ?>
		
		<div>
			<ol class="breadcrumb">
				<li>PUKIS</li>
				<li><?php echo $this->params['plugin']; ?></li>
				<li><?php echo $this->params['controller']; ?></li>
				<li class="active"><?php echo str_replace('admin_', '', $this->params['action']);  ?></li>
			</ol>
		</div>
	</div>
</div>