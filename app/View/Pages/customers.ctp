<div class="pages index">
<?php //echo $this->Form->create('Page');?>

<h2><?php echo $helpdata['name']?></h2>
The Customers section of computāre is where you track your accounts receivables.  

<?php echo array_shift($helpdata['anchors']);?>

A basic index is available to view customers.
To open <?php echo $this->Html->link(__('Click Here'),array('controller'=>'customers'),array('target'=>'none')); ?>.
<?php echo $this->Html->image('Help/customers0.png',array('class'=>'screenshot')); ?>
The Filters section is where you can select criteria for the results you wish to see.  For example to see deleted customers, select 
"Show Deleted Customers" and click "Set Filters."  By clicking on "Filters" you can show or hide the options.
You can sort data by the various columns by clicking their header.

<?php echo array_shift($helpdata['anchors']);?>

<?php echo array_shift($helpdata['anchors']);?>

<?php echo array_shift($helpdata['anchors']);?>

<?php echo $this->element('guidenav');?>
</div>