<div class="users-users-admin-change">
	
	<?php echo $this->element('Pukis\pukis_title', array(), array('plugin' => 'Pukis')); ?>
	
	<div>
		<div class="col-sm-offset-2 col-sm-10">
		  	<?php 
			  	echo $this->Html->link(
			  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left')) . __d('admin', 'Back'),  
			  		array(
				  		'plugin' => 'users', 
				  		'controller' => 'users', 
				  		'action' => 'index',
				  		'admin' => true),
			  		array(
			  			'class' => 'btn btn-primary',
			  			'escape' => false)
			  		);
			  	?>
		</div>
	</div>
	
	<div>
		<div class="col-md-12">
			<?php 
				echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form'));
				echo $this->Form->input('id', array('value' => $this->request->pass[0]));
			?>
			
			<div class="form-group <?php echo $this->Form->isFieldError('password') ? 'has-error' : '' ?>">
			  	<label class="col-sm-2 control-label"><?php echo __d('users', 'Password:'); ?></label>
			  	<div class="col-md-6 col-sm-10">
			    <?php 
			      echo $this->Form->input('password', array(
			        'div' => false,
			        'label' => false,
			        'class' => 'form-control',
			        ));
			    ?>
			 	</div>
			</div>
			
			<div class="form-group <?php echo $this->Form->isFieldError('password_again') ? 'has-error' : '' ?>">
			  	<label class="col-sm-2 control-label"><?php echo __d('users', 'Password again:'); ?></label>
			  	<div class="col-md-6 col-sm-10">
			    <?php 
			      echo $this->Form->password('password_again', array(
			        'div' => false,
			        'label' => false,
			        'class' => 'form-control',
			        ));
			     ?>
			  	</div>
			</div>
			
			<div class="form-group">
			  	<div class="col-sm-offset-2 col-sm-10">
			  		<?php 
					  	echo $this->Html->link(
					  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left')) . __d('admin', 'Back'),  
					  		array(
						  		'plugin' => 'users', 
						  		'controller' => 'users', 
						  		'action' => 'index',
						  		'admin' => true),
					  		array(
					  			'class' => 'btn btn-primary',
					  			'escape' => false)
					  		);
					  	?>
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
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();

		$('.users-users-admin-change a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxRequest(this, this.href, '.body');
		});
		
		$('.users-users-admin-change form').submit(function(e){
			e.preventDefault();
			pukisRequest.ajaxType('post').ajaxRequest(this, this.action, '.body');
		});
		
	})
</script>