<div class="contacts form">
<?php echo $this->Form->create('Contact'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contact for '.$name); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('value',array('id'=>'sc','label'=>$this->request->data['Contact']['field_name']));
		echo $this->Form->input('field_name',array('type'=>'hidden'));
		echo $this->Form->input('vendor_id',array('type'=>'hidden'));
		echo $this->Form->input('customer_id',array('type'=>'hidden'));
		echo $this->Form->input('active',array('type'=>'hidden'));
	?>
	<?php echo $this->Form->end(__('Submit'));?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>