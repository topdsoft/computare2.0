<div class="scanCodes form">
<?php echo $this->Form->create('ScanCode'); ?>
	<fieldset>
		<legend><?php echo __('Lookup Scan Code'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('ScanCodeCode').focus();</script>