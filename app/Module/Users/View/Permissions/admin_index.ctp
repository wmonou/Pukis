<div class="users-permissions-admin-index">
	<div>
		<div class="col-md-12">
			<?php echo $this->Pukis->getTitle(); ?>
		</div>
	</div>
	
	<div>
		<div class="col-md-12">
				<?php 
					echo $this->Html->link(
						$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-refresh')) . __d('admin', 'Sincronize'), 
						array('plugin' => 'users', 'controller' => 'permissions', 'action'=>'sync', 'admin' => true), 
						array('class' => 'sync btn btn-default', 'escape' => false)); 
				?>
		</div>
	</div>
	
	<div>
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-acl">
				<?php
					$roleTitles = array_values($roles);
					$roleIds   = array_keys($roles);
	
					$tableHeaders = array(
						__d('users', 'Section')
					);
					$tableHeaders = array_merge($tableHeaders, $roleTitles);
					$tableHeaders =  $this->Html->tag('thead', $this->Html->tableHeaders($tableHeaders));
					echo $tableHeaders;
	
					$currentController = '';				
					foreach( $controllers AS $controller )
					{
						$controllerName[] = preg_replace('/Controller$/', '', $controller);					
					}
					
					foreach ($acos AS $id => $alias) {
						$class = '';					
						if(substr($alias, 0, 1) == '_') {
							$level = 1;
							$class .= 'level-'.$level;
							$oddOptions = array('class' => 'controller-'.$currentController);
							$evenOptions = array('class' => 'controller-'.$currentController);
							$alias = substr_replace($alias, '', 0, 1);	
							
							if ( substr($alias, 0, 1) == '_' ) {
								$alias = substr_replace($alias, '', 0, 1);
								$alias = $this->Html->tag('span', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&rarr;  ', array('class' => 'bulet')) . preg_replace('/\_/', ' ', ucfirst($alias));
							}else{			
								if ( in_array($alias, $controllerName) ) {
									$alias = $this->Html->tag('div', '&nbsp;&nbsp;  ' . preg_replace('/\_/', ' ', ucfirst($alias)), array('class' => 'bold'));
								}else{
									$alias = $this->Html->tag('span', '&nbsp;&nbsp;&rarr;  ', array('class' => 'bulet')) . preg_replace('/\_/', ' ', ucfirst($alias));
								}							
							}
						} else {
							$level = 0;
							$class .= ' controller expand bold';
							$oddOptions = array();
							$evenOptions = array();
							$currentController =  $alias;
						}
	
						$row = array(
							$this->Html->div($class, $alias),
						);
	
						foreach ($roles AS $roleId => $roleTitle) {
							if ($level != 0) {
								if ($roleId != 1) {
									if ($permissions[$id][$roleId] === 1) {
										$row[] = $this->Html->tag('span', __d('users', 'allowed'), array(
											'class' => 'label label-success permission-toggle', 
											'data-aco_id' => $id, 
											'data-aro_id' => $rolesAros[$roleId],
											'data-rel'=>"tooltip",
											'data-original-title'=>$roleTitle
										));
									} else {
										$row[] = $this->Html->tag('span', __d('users', 'denied'), array(
											'class' => 'label label-danger permission-toggle', 
											'data-aco_id' => $id, 
											'data-aro_id' => $rolesAros[$roleId],
											'data-rel'=>"tooltip",
											'data-original-title'=>$roleTitle
											));
									}
								} else {
									$row[] = $this->Html->tag('span', __d('users', 'allowed'), array('class' => 'permission-disabled label label-default'));
								}
							} else {
								$row[] = '-';
							}
						}
	
						echo $this->Html->tableCells(array($row), $oddOptions, $evenOptions);
					}
				?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->script('/users/js/users.js'); ?>
<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
		var usersRequest = new PUKISAPP.BEHAVIOR.USERS.permissions();
		
		$('.users-permissions-admin-index a.sync').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxLinkRequest(this, this.href, $('.users-permissions-admin-index').parent());
		});

		usersRequest.aclChange();
				
		$('[data-rel=tooltip]').tooltip({placement: 'left'});
		
	})
</script>