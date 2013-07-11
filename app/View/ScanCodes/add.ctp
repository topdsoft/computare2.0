<div class="scanCodes form">
<?php echo $this->Form->create('ScanCode'); ?>
	<fieldset>
		<legend><?php echo __('Add Scan Code'); ?></legend>
	<?php
		echo $this->Form->input('print',array('label'=>'Queue Printing'));
		echo $this->Form->input('internal',array('label'=>'Generate Scan Code'));
		echo $this->Form->input('code');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('ScanCodeCode').focus();</script>
<script type='text/javascript'>
	$('#ScanCodeInternal').change(function(){
//		$('#ScanCodeCode').prop('disabled',$(this).is(":checked"));
		if($(this).is(":checked")) $('.text').hide();
		else $('.text').show();
//		alert($(this).is(":checked"));
	} );
</script>