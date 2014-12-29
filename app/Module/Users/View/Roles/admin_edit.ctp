<div class="users-roles-admin-edit">
	
	<?php echo $this->element('Pukis/pukis_title', array(), array('plugin' => 'Pukis')); ?>
	
	<div>
		<div class="col-sm-offset-2 col-sm-10">
		  	<?php 
			  	echo $this->Html->link(
				  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left')) . __d('admin', 'Back'),  
					  	"/admin/users/roles/index", 
				  		array('class' => 'btn btn-primary', 'escape' => false));
		  	?>
		</div>
	</div>
	
	<div>
		<div class="col-md-12">
			<?php 
				echo $this->Form->create('Role', array('class' => 'form-horizontal', 'role' => 'form')); 
				echo $this->Form->input('id');
			?>
			
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
						  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left')) . __d('admin', 'Back'),  
							  	"/admin/users/roles/index", 
						  		array('class' => 'btn btn-primary', 'escape' => false));
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

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajax();

		$('.users-roles-admin-edit a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxRequest(this, this.href, '.body');
		});
		
		$('.users-roles-admin-edit form').submit(function(e){
			e.preventDefault();
			pukisRequest.ajaxType('post').ajaxRequest(this, this.action, '.body');
		});
		
	})
</script>