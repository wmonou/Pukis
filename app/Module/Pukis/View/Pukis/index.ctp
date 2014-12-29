<div id="content">
	<div class='jumbotron bg-pukis ft-white'>
		<div class="container">
			<h1>PUKIS <small class="ft-white">user management dashboard Ver. <?php echo Configure::read('Dev.ver')?></small></h1>
			<p>Pukis is made using CakePHP to accomodate full ajax application.</p>
			<a href="" class="btn btn-default"><i class="fa fa-github"></i> Downoload</a>
			<a href="/admin/users/login" class="demo btn btn-default">Demo</a>
		</div>
	</div>

	<div class="container">
		<p>
		CakePHP is choosen for this projects because its provides the main reason of a framework which would help us to launch the project faster.
		In the other side, using ajax will faster your application load since it doesn't to transfer the additional resources (css, js, etc) everytime request is performed. Ajax bypasing to check wheter they are exist or not on your web browser cache.
		</p>
	</div>

	<div class="container">
		<h3>Features :</h3>
		<ul>
			<li>Ajax User Management - Ajax access control list user management</li>
			<li>Json Configuration Management - Configuration setting management for your application in json</li>
			<li>Table Helper - Generate your table and pagination only with configurations</li>
		</ul>
	</div>

	<div class="container">
		<h3>Plan for Future Version :</h3>
		<ul>
			<li>Frontend - Angular.js integration</li>
			<li>Backend - SOA architecture</li>
			<li>Functionality - Emails</li>
			<li>Functionality - Pages and Menu</li>
		</ul>
	</div>

	<div class="container">
		<h3>Wishlist :</h3>
		<ul>
			<li><a href="http://wmonou.com" target="new"><i class="fa fa-external-link"></i> Visit my website for wishlist</a></li>
		</ul>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajax();

	$('a.demo').click(function(e){
		e.preventDefault();
		request.ajaxRequest(this, this.href);
	});

});
</script>