<div class="users-users-admin-delete">

	<?php echo $this->element('Pukis/pukis_title', array(), array('plugin' => 'Pukis')); ?>

	<div>
		<div class="col-md-6">

		    <div class="modal-content">
		      	<div class="modal-header">
		      		<?php 
					  	echo $this->Html->link(
					  		"x", "/admin/users/roles/index", 
					  			array('class' => 'close', 'escape' => false));
				  	?>
		        	<h4 class="modal-title">
		        		<?php echo $this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-warning')), __d('admin', 'Delete') ?>
		        	</h4>
		      	</div>
		      	
		      	<div class="modal-body">
		        	<p>
		        	<?php 
				    	echo String::insert(__d('users', 'Are you sure to delete this role with :deleteKey :deleteValue ?'), 
				    		array('deleteKey' => $key, 'deleteValue' => $id)); 
				    ?>
				    </p>
		      	</div>
		      	
		      	<div class="modal-footer">
		        	<?php 
					  	echo $this->Html->link(
					  		$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-arrow-left')) . __d('admin', 'Back'),  
					  		"/admin/users/roles/index", 
					  		array('class' => 'btn btn-primary', 'escape' => false));
				  	?>
				  	<?php 
					  	echo $this->Html->link(
					  		__d('admin', 'Delete'),  
					  		"/admin/users/roles/delete/$id/1",
					  		array('class' => 'btn btn-danger','escape' => false));
				  	?>
		      	</div>
		    </div><!-- /.modal-content -->

		</div>
	</div>
	
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajax();

		$('.users-users-admin-delete a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxRequest(this, this.href, '.body');
		});

		$( ".modal-content" ).draggable({ containment: $('.frame'), scroll: false});

	})
</script>