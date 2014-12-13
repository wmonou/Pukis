<div id="splash">
	<div id="logo">
		<h1>PUKIS</h1>
		<p>Version 0.1.0</p>
		<p>Pukis is made to accomodate full ajax application.</p>
		<a href="" class="btn btn-default">Downoload</a>
		<a href="/admin/user/login" class="demo btn btn-default">Demo</a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	$('a.demo').click(function(e){
		e.preventDefault();
		var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest(this);
		request.ajaxLinkRequest(); 		
	});
	
});
</script>