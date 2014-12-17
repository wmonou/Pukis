<div>
	<h1>PUKIS</h1>
	<p>Version 0.1.0</p>
	<p>Pukis is made to accomodate full ajax application.</p>
	<a href="" class="btn btn-default">Downoload</a>
	<a href="/admin/users/login" class="demo btn btn-default">Demo</a>
</div>

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
	
	$('a.demo').click(function(e){
		e.preventDefault();
		request.ajaxLinkRequest(this, this.href); 		
	});
	
});
</script>