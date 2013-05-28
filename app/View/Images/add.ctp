<div class="images form">
<?php echo $this->Form->create('Image',array('type' => 'file'));?>
	<fieldset>
	<?php 
		$headline='';
		if(isset($car)) $headline=' for Car: '.$car['Car']['name'];
		if(isset($loco)) $headline=' for Locomotive: '.$loco['Loco']['name'];
	?>
		<legend><?php echo __('Upload Images'.$headline); ?></legend>
		You may upload up to 20 files at a time, but they can not exceed 16MB total.
	<?php
//		echo $this->Form->input('filename');
		echo $this->Form->file('Image/name1',array('multiple','name'=>'data[Images][]'));
//		echo $this->Form->input('notes');
	?>
	<?php echo $this->Form->end(__('Submit'));?>
	</fieldset>
</div>
