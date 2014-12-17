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
  						'urlParam' =>'Menu.id',
  						'iconClass' => 'fa fa-pencil',			
  						'confirm' => 'are you sure?',			
  						'options' => array()),					
                   'delete' => array(
  						'urlPrefix' => '/properties/view/', 
  						'urlParam' =>'Menu.id', 
  						'iconClass' => 'fa fa-trash-o',
  						'confirm' => 'are you sure?',
  						'options' => array())
                   	);
	$tableOptions = array('class' => 'table table-bordered table-condensed table-hover');
  
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