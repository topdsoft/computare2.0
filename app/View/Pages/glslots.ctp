<div class="pages index">
<?php //echo $this->Form->create('Page');?>

<h2><?php echo $helpdata['name']?></h2>
<p>This form is designed to set up what General Ledger accounts are used for what purpose in your system.  This setup gives you the flexibility to run your 
system how you want.  Changes here can have drastic impact on a working system and are logged when made.</p>


To open <?php echo $this->Html->link(__('Click Here'),array('controller'=>'glslots','action'=>'edit'),array('target'=>'none')); ?>.
<?php //echo $this->Html->image('Help/customers0.png',array('class'=>'screenshot')); ?>

<p>The form consists of a list of "Slots" and a debit and credit account assigned to that slot.  When the system performs a task (such as a sale) amounts will be 
posted to the accounts that you choose.</p>
<p>The list of slots are gouped by a task such as paying an invoice.  Following below is a list of each of these groups:</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>Receive Inventory is used anytime new inventory is brought into the system that has a cost greather than 0.</p>
<p>The "Accounts Payable" slot is the total amount on the invoice.  If you have a seperate account set up for the vendor, that vendor's AP account will be 
used instead of the account set here.  This account should be set even if you plan to have seperate accounts for all your vendors.  Typically this should be used
to credit the account when a purchase is made.  This acount is assumed to be a credit account and the debit option is not available.</p>
<p>The "Inventory Assets" slot is ONLY the cost of the items recieved.  It is typically used to debit an inventory assets account when merchandise comes in.</p>
<p>The "Shipping" slot is ONLY the shiping costs.  It is typically used to debit an account.</p>
<p>The "Tax" slot is ONLY taxes paid.  It is typically used to debit an account.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>Pay Invoice is used when you pay your vendor accounts.</p>
<p>The "Accounts Payable" slot is the amount on the invoice MINUS any interest charged.  It is used to cancel the credit amount when the invoice was recieved.</p>
<p>The "Interest" slot is used to add on any iterest charges paid.  It is usually a debit to balance the cretid to the cash account.</p>
<p>The "Cash" slot is the account that will be posted with the total amount paid.  This is usually a credit.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>

<?php echo $this->element('guidenav');?>
</div>