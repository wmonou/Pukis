<?php echo $this->element('Pukis/pukis_header', array(), array('plugin' => 'Pukis')); ?>

<div id="content">
	<div class="pukis-admin-menu">
		
		<div class="menu col-md-2 col-xs-3">
			<!-- Menu -->
			<aside class="sidebar">
				<?php echo $this->Menu->createMenu($sidebar); ?>
			</aside>
		</div>
		
		<div class="frame col-md-10 col-md-offset-2 col-xs-9 col-xs-offset-3">
			<div class="body">
				<div class="pukis-pukis-admin-edit">
					<?php echo $this->element('Pukis/pukis_title', array(), array('plugin' => 'Pukis')); ?>
				</div>
				
				<div>
					<div class = 'container-fluid'>
						<h1>PUKIS</h1>
						<p>Version 0.1.0</p>
						<p>Pukis is made to accomodate full ajax application.</p>
					</div>
				</div>	
			</div>
		</div>
		
		<!-- loader  -->
		<div id="loader">
			
		</div>
		
		<!-- modal  -->
		<div id="modal"aria-hidden="true">
		  	
		</div>		
	</div>
</div>

<?php echo $this->element('Pukis/pukis_footer', array(), array('plugin' => 'Pukis')); ?>

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajax();

	$('#header a').click(function(e){
		e.preventDefault();
		request.ajaxRequest(this, this.href, $('#header').parent());
	});
	
	$('.sidebar a.sidebar-nav-item-a').click(function(e){
		e.preventDefault();
		request.ajaxRequest(this, this.href, '.body');
	});
	
	$('.sidebar').metisMenu();
	
});
</script>