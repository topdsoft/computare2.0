<div class="pages index">
<?php //echo $this->Form->create('Page');?>

<h2><?php echo $helpdata['name']?></h2>
<!-- text here -->

<?php echo array_shift($helpdata['anchors'])//sub headings;?>

<?php echo array_shift($helpdata['anchors'])//sub headings;?>

<?php echo array_shift($helpdata['anchors'])//sub headings;?>

<?php echo array_shift($helpdata['anchors'])//sub headings;?>

<?php echo $this->element('guidenav');?>
</div>