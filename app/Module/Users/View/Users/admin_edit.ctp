<div class="users-users-admin-edit">
	<div>
		<div class="col-md-12">
			<?php echo $this->Pukis->getTitle(); ?>
		</div>
	</div>

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
		    <?php 
		      	echo $this->Html->link(
		      		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-key')) . __d('users', 'Change password'),
		      		 array(
				        'plugin' => 'users',
				        'controller' => 'users',
				        'action' => 'change_password',
				        'admin' => true,
				        $this->request->pass[0]),
		      		array(
			  			'class' => 'btn btn-primary',
			  			'escape' => false)
		      		); 
		    ?>
		</div>
	</div>
	
	<div style="height: 8px;"></div>
	
	<div>
		<div class="col-md-12">
			<?php 
				echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form')); 
				echo $this->Form->input('id');
			?>
			
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo __d('users', 'Role'); ?>:</label>
				<div class="col-md-6 col-sm-10">
				  <?php 
					echo $this->Form->input('role_id', array(
					  'div' => false,
					  'label' => false,
					  'class' => 'form-control',
					  ));
				   ?>
				</div>
			</div>

			<div class="form-group <?php echo $this->Form->isFieldError('email') ? 'has-error' : '' ?>">
				<label for="inputPassword3" class="col-sm-2 control-label">E-mail</label>
				<div class="col-md-6 col-sm-10">
					<?php 
					echo $this->Form->input('email', array(
					  'div' => false,
					  'label' => false,
					  'class' => 'form-control',
					  'placeholder' => 'E-mail'
					  ));
					?>
				</div>
			</div>
			
			<div class="form-group <?php echo $this->Form->isFieldError('username') ? 'has-error' : '' ?>">
				<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __d('users', 'Username'); ?></label>
				<div class="col-md-6 col-sm-10">
				  <?php 
					echo $this->Form->input('username', array(
					  'div' => false,
					  'label' => false,
					  'class' => 'form-control',
					  'placeholder' => 'Username'
					  ));
				   ?>
				</div>
			</div>
			
			<div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __d('users', 'status'); ?></label>
			    <div class="col-md-6 col-sm-10">
				    <?php 
				      echo $this->Form->input('status', array(
				        'div' => false,
				        'label' => false,
				        'class' => 'form-control',
				        'type' => 'select',
				        'options' => array(
				          1 => __d('users', 'Active'),
				          0 => __d('users', 'Unactive'),
				          )
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

		$('.users-users-admin-edit a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxFormRequest(this, this.href, '.body');
		});
		
		$('.users-users-admin-edit form').submit(function(e){
			e.preventDefault();
			pukisRequest.ajaxFormRequest(this, this.action, '.body');
		});
		
	})
</script>