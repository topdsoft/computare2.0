<div class="pages index">
<?php //echo $this->Form->create('Page');?>

<h2><?php echo $helpdata['name']?></h2>
<p>This form is designed to set up what General Ledger accounts are used for what purpose in your system.  This setup gives you the flexibility to run your 
system how you want.  Changes here can have drastic impact on a working system and are logged when made.</p>


To open <?php echo $this->Html->link(__('Click Here'),array('controller'=>'glslots','action'=>'edit'),array('target'=>'none')); ?>.
<?php //echo $this->Html->image('Help/customers0.png',array('class'=>'screenshot')); ?>

<p>The form consists of a list of "Slots" and a debit and credit account assigned to that slot.  When the system performs a task (such as a sale) amounts will be 
posted to the accounts that you choose.</p>
<p>The list of slots are grouped by a task such as paying an invoice.  Following below is a list of each of these groups:</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>Receive Inventory is used anytime new inventory is brought into the system that has a cost greater than 0.</p>
<p>The "Accounts Payable" slot is the total amount on the invoice.  If you have a separate account set up for the vendor, that vendor's AP account will be 
used instead of the account set here.  This account should be set even if you plan to have separate accounts for all your vendors.  Typically this should be used
to credit the account when a purchase is made.  This account is assumed to be a credit account and the debit option is not available.</p>
<p>The "Inventory Assets" slot is ONLY the cost of the items received.  It is typically used to debit an inventory assets account when merchandise comes in.</p>
<p>The "Shipping" slot is ONLY the shipping costs.  It is typically used to debit an account.</p>
<p>The "Tax" slot is ONLY taxes paid.  It is typically used to debit an account.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>Pay Invoice is used when you pay your vendor accounts.</p>
<p>The "Accounts Payable" slot is the amount on the invoice MINUS any interest charged.  It is used to cancel the credit amount when the invoice was received.</p>
<p>The "Interest" slot is used to add on any interest charges paid.  It is usually a debit to balance the credit to the cash account.</p>
<p>The "Cash" slot is the account that will be posted with the total amount paid.  This is usually a credit.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>When inventory is issued out of the system, the value of that inventory needs to be removed from inventory assets.  
The accounts affected when an issue is made are set here. This does not include when inventory is issued after a sale. Using 
<?php echo $this->Html->link('Issue Types',array('controller'=>'issueTypes')); ?> you can define different types of issues.</p>
<p>The first slot is the account that is debited with the value of inventory issued.  If there is an issue type used and that issue type
has a GL account set to it, the account set here will be overridden by the one set for the issue type.</P>
<p>The second account is never overridden.  It would typically be used for crediting an assets account.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>The Sale on Account section is for sales made to a customer where the payment is deferred. The first four slots are for when
the initial purchase is made and the last two when a payment is made.</p>
<p>The "Total Amount" slot is th amount of the invoice including shipping and tax.  An account set here will be overridden by a
specific account set up for the customer.</P>
<p>The next three slots are for balancing the first.  They should be credit accounts.</p>
<p>the last two slots are used when the customer makes a payment on an account.  One is a credit and is overridden by a customer
specific account.  The other is not and is typically a debit to a cash account.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>The Cash Sale section if for sales that are paid for upon receipt.  The "Total Amount" slot is for debiting a cash assets account.
The other two are for balancing credit accounts.</p>

<?php echo array_shift($helpdata['anchors']);?>
<p>The All Sales section is for updating inventory assets and cost of goods sold accounts</p>

<?php echo $this->element('guidenav');?>
</div>