<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add First User'); ?></legend>
		<strong>
		This user will have access to all forms system wide for this company, including the ability to add other users and give them permissions.
		This account can be de-activated at a later time.
		After clicking Submit, you will need to log in with this username and password to start using computāre.
		</strong>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('UserUsername').focus();</script>