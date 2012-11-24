<div class="glaccounts view">
<h2><?php  echo __('GL Account: ').$glaccount['Glaccount']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Account Group'); ?></dt>
		<dd>
			<?php echo h($glaccount['Glaccount']['group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($glaccount['Glaccount']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($glaccount['Glaccount']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$glaccount['Glaccount']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified'); ?></dt>
		<dd>
			<?php echo h($glaccount['GlaccountDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo $users[$glaccount['GlaccountDetail']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Debit Total'); ?></dt>
		<dd>
			<?php echo $balance[0][0]['debit']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit Total'); ?></dt>
		<dd>
			<?php echo $balance[0][0]['credit']; ?>
			&nbsp;
		</dd>
		<?php if($balance[0][0]['debit']>$balance[0][0]['credit']): ?>
		<dt><?php echo __('Debit Balance'); ?></dt>
		<dd>
			<?php echo number_format($balance[0][0]['debit']-$balance[0][0]['credit'],2); ?>
			&nbsp;
		</dd>
		<?php else: ?>
		<dt><?php echo __('Credit Balance'); ?></dt>
		<dd>
			<?php echo number_format($balance[0][0]['credit']-$balance[0][0]['debit'],2); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
	</dl>
</div>
<div class="related">
	<?php if (!empty($glaccount['Glentry'])): ?>
	<h3><?php echo __('General Ledger Entries'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Post Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Debit'); ?></th>
		<th><?php echo __('Credit'); ?></th>
		<th><?php echo __('Check Num'); ?></th>
		<th><?php echo __('Notes'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($glaccount['Glentry'] as $glentry): ?>
		<tr>
			<td><?php echo $glentry['postDate']; ?></td>
			<td><?php echo $glentry['created']; ?></td>
			<td><?php echo $users[$glentry['created_id']]; ?></td>
			<td><?php echo $glentry['debit']; ?></td>
			<td><?php echo $glentry['credit']; ?></td>
			<td><?php if($glentry['Glcheck']) echo $glentry['Glcheck']['checkNumber']; ?></td>
			<td><?php if($glentry['Glnote']) echo '<span title="'.$glentry['Glnote']['text'].'">NOTES</span'; ?></td>
		</tr>
	<?php endforeach; ?>
	<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
	<tr><th></th><th></th><th>Total</th>
	<th><?php if($balance[0][0]['debit']>0) echo $balance[0][0]['debit']; ?></th>
	<th><?php if($balance[0][0]['credit']>0) echo $balance[0][0]['credit']; ?></th>
	<th></th><th></th></tr>
	</table>
<?php endif; ?>
</div>
