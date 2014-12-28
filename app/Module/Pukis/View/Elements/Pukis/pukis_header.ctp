<div id="header">
	<div class="col-md-6">
		<a href="/admin/pukis">Pukis User Management</a>
	</div>
	<div class="col-md-6 text-right">
		<?php if (isset($authUserId)) { ?>
			<a href="/admin/users/users/logout"><i class="fa fa-power-off"></i> Logout</a>
		<?php } ?>
	</div>
</div>