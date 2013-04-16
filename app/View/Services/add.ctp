<div class="services form">
<?php echo $this->Form->create('Service'); ?>
	<fieldset>
		<legend><?php echo __('Add Service'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
		echo $this->Form->input('pricing',array('type'=>'select','options'=>$pricingOptions));
		echo $this->Form->input('rate');
		echo $this->Form->input('fixedRate');
		echo $this->Form->input('description');
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>