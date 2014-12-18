<div class="users-roles-admin-index">
	<div>
		<div class="col-md-12">
			<?php echo $this->Pukis->getTitle(); ?>
		</div>
	</div>

	<div>
		<div class="col-md-12">
		  	<?php 
		  		echo $this->Html->link(
		  			$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-plus'))  . __d('admin', 'Add'),
		  			array(
		  				'plugin' => 'users',
		  				'controller' => 'roles',
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
			<table class="table table-hover">
		      	<?php 
			      	$tableHeaders = array(
			      		__d('users', 'Name'),
						__d('users', 'Actions')
			      	);
			      	$tableHeaders =  $this->Html->tableHeaders($tableHeaders);
			      	echo $this->Html->tag('thead', $tableHeaders);
		       	?>
			    <tbody>
			    <?php 
			       	$rows = array();
			       	foreach ($roles as $role) {
						$actions = $this->Html->link(
							$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-pencil')) . __d('users', 'Edit'), 
							array(
								'plugin' => 'users',
								'controller' => 'roles',
								'action' => 'edit',
								'admin' => true,
								$role['Role']['id']), 
							array('class' => 'btn btn-primary btn-xs', 'escape' => false));
						$actions .= '&nbsp;'.$this->Html->link(
							$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-trash-o')) . __d('users', 'Delete'), 
							array(
								'plugin' => 'users',
								'controller' => 'roles',
								'action' => 'delete',
								'admin' => true,
								$role['Role']['id']), 
							array('class' => 'btn btn-danger btn-xs', 'escape' => false));
			       		$rows[] = array(
			       			$role['Role']['name'],
							$actions
			       			); 
			       	}
			       	echo $this->Html->tableCells($rows);
			    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
		
		$('.users-roles-admin-index a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxFormRequest(this, this.href, '.body');
		});
		
	})
</script>