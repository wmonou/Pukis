<div class="menu-admin-index">

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
</div>

<script type="text/javascript">
$(document).ready(function() {

	$('.menu-admin-index a').click(function(e){
		e.preventDefault();
		var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest(this);
		request.ajaxLinkRequest();
	});

	$('.menu-admin-index form').submit(function(e){
		e.preventDefault();
		var model = PUKISAPP.BEHAVIOR.PUKIS;
		var request = new model.ajaxRequest(this);
		request.ajaxFormRequest();
	});

});
</script>