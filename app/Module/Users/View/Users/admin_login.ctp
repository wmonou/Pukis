<div id="login" class="user-admin-login container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-">PUKIS</h1>
			<h3><small>User Management Dashboard</small></h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
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

<script type="text/javascript">
$(document).ready(function() {

	var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest();
	$('.user-admin-login a').click(function(e){
		e.preventDefault();
		request.ajaxLinkRequest(this, this.href);	
	});	

	$('.user-admin-login form').submit(function(e){
		e.preventDefault();
		request.ajaxFormRequest(this, this.action); 		
	});	
	
});
</script>