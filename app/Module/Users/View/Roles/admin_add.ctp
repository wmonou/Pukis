<div class="users-roles-admin-add">
	<div>
		<div class="col-md-12">
			<?php echo $this->Pukis->getTitle(); ?>
		</div>
	</div>
	
	<div>
		<div class="col-sm-offset-2 col-sm-10">
		  	<?php 
			  	echo $this->Html->link(
			  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left'))  .__d('admin', 'Back'), 
			  		array(
				  		'plugin' => 'users', 
				  		'controller' => 'roles', 
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
			<?php echo $this->Form->create('Role', array('class' => 'form-horizontal', 'role' => 'form')); ?>
      
	      	<div class="form-group <?php echo $this->Form->isFieldError('name') ? 'has-error' : '' ?>">
		        <label class="col-sm-2 control-label"><?php echo __d('admin', 'Name:'); ?></label>
		        <div class="col-md-6 col-sm-10">
		          <?php 
		            echo $this->Form->input('name', array(
		              'div' => false,
		              'label' => false,
		              'class' => 'form-control',
		              'placeholder' => 'Name'
		              ));
		           ?>
		        </div>
	      	</div>
      
	      	<div class="form-group">
		        <div class="col-sm-offset-2 col-sm-10">
		        	<?php 
				  	echo $this->Html->link(
				  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left'))  .__d('admin', 'Back'), 
				  		array(
					  		'plugin' => 'users', 
					  		'controller' => 'roles', 
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
					   			'label' =>  __d('users', 'Save'), 
					   			'class' => 'btn btn-success', 
					   			'div' => false)
					   		); 
		        	?>
		        </div>
	      	</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();

		$('.users-roles-admin-add a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxFormRequest(this, this.href, '.body');
		});
		
		$('.users-roles-admin-add form').submit(function(e){
			e.preventDefault();
			pukisRequest.ajaxFormRequest(this, this.action, '.body');
		});
		
	})
</script>