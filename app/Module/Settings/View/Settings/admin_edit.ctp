<div class="users-settings-admin-edit">
	
	<?php echo $this->element('Pukis/pukis_title', array(), array('plugin' => 'Pukis')); ?>
	
	<div>
		<div class="col-sm-offset-2 col-sm-10">
		  	<div class="btn-group">
			  	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    	<?php echo __d('settings', 'Setting')?> <span class="caret"></span>
			  	</button>
			  	<ul class="dropdown-menu" role="menu">
				    <li><a href="/admin/settings/settings/edit/key:Site">Site</a></li>
				    <li><a href="/admin/settings/settings/edit/key:Meta">Meta</a></li>
				    <li><a href="/admin/settings/settings/edit/key:Email">Email</a></li>
			  	</ul>
			</div>
		</div>
	</div>
	
	
	<div>
		<div class="col-md-12">
			<?php 
				echo $this->Form->create('Config', array('class' => 'form-horizontal', 'role' => 'form'));
			?>
						
			<?php foreach ($configs as $configKey => $configVal) { ?>
					<div class="form-group">
						<label for="input<?php echo ucwords($configKey)?>" class="col-sm-2 control-label">
							<?php echo $key . ' ' . ucwords(__d('settings', $configKey)); ?></label>
						<div class="col-md-6 col-sm-10">
							<?php echo $this->Form->input($key.'.'.$configKey, array(
									'value' => $configVal,
									'label' => false,
									'class' => 'form-control',
									'placeholder' => 'Username'));
							?>
						</div>
					</div>
			<?php } ?>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<?php 
				        echo $this->Form->end(
					   		array(
					   			'label' => __d('users', 'Save'), 
					   			'class' => 'btn btn-success', 
					   			'div' => false)); 
				    ?>
				</div>				
			</div>
		</div>
	</div> 
</div>	
	
<script type="text/javascript">
	$(document).ready(function() {
	
		var request = new PUKISAPP.BEHAVIOR.PUKIS.ajax();
		
		$('.users-settings-admin-edit a').click(function(e){
			e.preventDefault();
			request.ajaxRequest(this, this.href, '.body');
		});

		$('.users-settings-admin-edit form').submit(function(e){
			e.preventDefault();
			request.ajaxType('post').ajaxRequest(this, this.action, '.body');
		});
	});
</script>