<div class="pukis-admin-menu">
	<div class="menu col-md-2 col-xs-3">
		<!-- Menu -->
		<aside class="sidebar">
			<?php echo $this->Menu->createMenu($sidebar); ?>
		</aside>
	</div>
	
	<div class="frame col-md-10 col-md-offset-2 col-xs-9 col-xs-offset-3">
		<div class="flash"></div>
		<div class="body"></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
	
	$('.sidebar a.sidebar-nav-item-a').click(function(e){
		e.preventDefault();
		request.ajaxLinkRequest(this, this.href, '.body');
	});
	
	$('.sidebar').metisMenu();
	
});
</script>