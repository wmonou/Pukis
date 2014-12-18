<div class="users-users-admin-index">
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
			<table class="table table-hover">
			      <?php 
			      	$tableHeaders = array(
			      		__d('admin', 'Name'),
			      		__d('admin', "Role"),
			      		'Email',
			      		__d('users', 'Username'),
			      		__d('users', 'Actions')
			      	);
			      	$tableHeaders =  $this->Html->tableHeaders($tableHeaders);
			      	echo $this->Html->tag('thead', $tableHeaders);
			       ?>
				<tbody>
		       	<?php 
		       	$rows = array();
		       	foreach ($users as $user) {
		       		$actions = $this->Html->link(
		       			$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-pencil')) . __d('users', 'Edit'), 
		       			array(
			       			'plugin' => 'users',
			       			'controller' => 'users',
			       			'action' => 'edit',
			       			'admin' => true,
			       			$user['User']['id']), 
		       			array('class' => 'btn btn-primary btn-xs', 'escape' => false));
		       		$actions.= '&nbsp;';
		       		$actions.=  $this->Html->link(
		       			$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-trash-o')) . __d('users', 'Delete'), 
		       			array(
			       			'plugin' => 'users',
			       			'controller' => 'users',
			       			'action' => 'delete',
			       			'admin' => true,
			       			$user['User']['id']), 
		       			array('class' => 'btn btn-danger btn-xs', 'escape' => false));
		       		$rows[] = array(
		       			$user['User']['username'],
		       			$user['Role']['name'],
		       			$user['User']['email'],
		       			$user['User']['username'],
		       			$actions
		       			); 
		       	}
		       	echo $this->Html->tableCells($rows);
		        ?>
				</tbody>		      
			</table>
			<div class="row-fluid">
			  	<ul class="pagination pull-right">
			    	<?php echo $this->Paginator->numbers( array('tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a', 'separator' => '') ); ?>
			    </ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
		
		$('.users-users-admin-index a').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxFormRequest(this, this.href, '.body');
		});
		
	})
</script>