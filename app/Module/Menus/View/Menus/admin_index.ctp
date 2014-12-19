<div class="menu-admin-index">

<?php echo $this->Html->link(
		"<li class='fa fa-plus'></li> " . __d('menus', 'Create New Menu'), 
		array('plugin'=>'menus', 'controller' => 'menus', 'action'=>'add', 'admin' => true),
		array('class' => 'btn btn-default', 'escape' => false)); ?>
		

<?php
 $displayFields = array(
  					'Id' => 'id',
                    'Name' => array(
                    	'fieldName' => 'name',
                    	'urlPrefix' => '/admin/menus/menuitems/index/',
                    	'urlParam' => 'Menu.id'
                    	)
 					);

  $actions = array('edit' => array(
  						'urlPrefix' => '/properties/view/', 	
  						'urlParam' =>'User.id',
  						'iconClass' => 'fa fa-pencil',			
  						'options' => array('class' => 'btn btn-primary btn-xs')),					
                   'delete' => array(
  						'urlPrefix' => '/properties/view/', 
  						'urlParam' =>'User.id', 
  						'iconClass' => 'fa fa-trash-o',
  						'options' => array('class' => 'btn btn-primary btn-xs'))
                   	);
  
print $this->Table->createTable('Menu', $menuData, $displayFields, $tableOptions, $actions);

?>

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
	
	$('.menu-admin-index a').click(function(e){
		e.preventDefault();
		request.ajaxLinkRequest(this, this.href, $('.menu-admin-index').parent());
	});

	$('.menu-admin-index form').submit(function(e){
		e.preventDefault();		
		request.ajaxFormRequest(this, this.action);
	});

});
</script>