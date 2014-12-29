<div class="users-users-admin-index">
	
	<?php echo $this->element('Pukis/pukis_title', array(), array('plugin' => 'Pukis')); ?>

	<div>
		<div class="col-md-12">
		  	<?php 
		  	echo $this->Html->link(
		  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-plus'))  . __d('admin', 'Add'), 
		  		array(
			  		'plugin' => 'users', 
			  		'controller' => 'users', 
			  		'action' => 'add', 
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
 			$displayFields = array(
                    'Name' => 'username',
 					'Email' => 'email',
 					'Role'	=> 'Role.name',
 					);

  			$actions = array('edit' => array(
  						'urlPrefix' => '/admin/users/users/edit/', 	
  						'urlParam' =>'User.id',
  						'iconClass' => 'fa fa-pencil',			
  						'options' => array('class' => 'btn btn-primary btn-xs')),		
                   'delete' => array(
  						'urlPrefix' => '/admin/users/users/delete/', 
  						'urlParam' =>'User.id', 
  						'iconClass' => 'fa fa-trash-o',
  						'options' => array('class' => 'btn btn-danger btn-xs'))
                   	);
  
			print $this->Table->createTable('User', $users, $displayFields, $actions);
			?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajax();
		
		$('.users-users-admin-index a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxRequest(this, this.href, '.body');
		});
		
	})
</script>