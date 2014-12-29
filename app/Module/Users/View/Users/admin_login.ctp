<div id="content">
	<div id="login" class="users-admin-login container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<h1 class="text-"><a href="/">PUKIS</a></h1>
				<h3><small>Ajax User Management Dashboard Ver. <?php echo (Configure::read('Dev.ver')); ?></small></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<?php echo $this->Session->flash(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'form-signin')); ?>
				<?php
					echo $this->Form->input('username', array(
							'label' =>  __d('users', 'username') . $this->Html->tag('span', ' *', array('class' => 'asterisk')),
							'div' => 'form-group',
							'class' => 'form-control',
							'placeholder' => __d('users', 'Username')
						));
					echo $this->Form->input('password', array(
							'label' => __d('users','password') . $this->Html->tag('span', ' *', array('class' => 'asterisk')),
							'div' => 'form-group',
							'class' => 'form-control',
							'placeholder' => __d('users', 'Password'),
							'type' => 'password'
						));
					?>
					<div class="checkbox">
					    <label>
					    	<?php echo $this->Form->checkbox('remember_me'), __d('users', 'Remember Me'); ?>
					    </label>
					</div>

				<?php echo $this->Form->end(array('label' => __d('users', 'Login'), 'class' => 'btn btn-lg btn-default pukis btn-block')); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajax();
	$('.users-admin-login a').click(function(e){
		e.preventDefault();
		request.ajaxType('post').ajaxRequest(this, this.href);
	});

	$('.users-admin-login form').submit(function(e){
		e.preventDefault();
		request.ajaxType('post').ajaxRequest(this, this.action);
	});

});
</script>