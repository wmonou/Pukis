<div class="users-permissions-admin-index">
	
	<?php echo $this->element('Pukis\pukis_title', array(), array('plugin' => 'Pukis')); ?>
	
	<div>
		<div class="col-md-12">
				<?php 
					echo $this->Html->link(
						$this->Html->tag('i', '&nbsp;', array('class' => 'fa fa-refresh')) . __d('admin', 'Sincronize'), 
						array('plugin' => 'users', 'controller' => 'permissions', 'action'=>'sync', 'admin' => true), 
						array('class' => 'sync btn btn-primary', 'escape' => false)); 
				?>
		</div>
	</div>
	
	<div>
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered table-acl">
				<?php
					$roleTitles = array_values($roles);
					$roleIds   = array_keys($roles);
	
					$tableHead = array(
						__d('users', 'Section')
					);
					$tableHead = array_merge($tableHead, $roleTitles);
					$tableHeaders =  $this->Html->tag('thead', $this->Html->tableHeaders($tableHead));
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
								$alias = $this->Html->tag('span', "<i class='fa fa-caret-right ft-pukis-soft'>&nbsp;</i>", array('class' => 'ofset-20')) . preg_replace('/\_/', ' ', ucfirst($alias));
							}else{			
								if ( in_array($alias, $controllerName) ) {
									$alias = $this->Html->tag('div', '&nbsp;&nbsp;  ' . preg_replace('/\_/', ' ', ucfirst($alias)), array('class' => 'bold'));
								}else{
									$alias = $this->Html->tag('span', "<i class='fa fa-caret-right ft-pukis-soft'>&nbsp;</i>", array('class' => 'ofset-10')) . preg_replace('/\_/', ' ', ucfirst($alias));
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
					
					$tableFooters =  $this->Html->tag('thead', $this->Html->tableHeaders($tableHead));
					echo $tableFooters;
				?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php //echo $this->Html->script('/users/js/users.js'); ?>
<script type="text/javascript">
	$(document).ready(function(){

		var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajax();
		//var usersRequest = new PUKISAPP.BEHAVIOR.USERS.permissions();
		
		$('.users-permissions-admin-index a.sync').click(function(e){
			e.preventDefault();
			pukisRequest.ajaxRequest(this, this.href, $('.users-permissions-admin-index').parent());
		});

		$(".permission-toggle").mouseover(function(){ $(this).css('cursor', 'pointer'); });
		$('.users-permissions-admin-index span.permission-toggle').click(function(e){
			e.preventDefault();
			var data = {aco_id: $(this).data('aco_id'), aro_id: $(this).data('aro_id')}
			pukisRequest.ajaxType('post').ajaxData(data).ajaxRequest(this, '/admin/users/permissions/change', $('.users-permissions-admin-index').parent());
		});

		$(".expand").mouseover(function(){ $(this).css('cursor', 'pointer'); });
		$('.expand').click(function(){
			if ( $('.controller-'+ $(this).text()).is(':visible') == true ) {
				$('.controller-'+ $(this).text()).addClass('hidden');
			}else{
				$('.controller-'+$(this).text()).removeClass('hidden');
			}
		});
			
		$('[data-rel=tooltip]').tooltip({placement: 'left'});
		
	})
</script>