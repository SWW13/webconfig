<div class="forwardings index">
	<h2><?php echo __('Forwardings'); ?></h2>
	<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('domain_id'); ?></th>
			<th><?php echo $this->Paginator->sort('local'); ?></th>
			<th><?php echo $this->Paginator->sort('source'); ?></th>
			<th><?php echo $this->Paginator->sort('destination'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($forwardings as $forwarding): ?>
	<tr>
		<td><?php echo h($forwarding['Forwarding']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($forwarding['Domain']['id'], array('controller' => 'domains', 'action' => 'view', $forwarding['Domain']['id'])); ?>
		</td>
		<td><?php echo h($forwarding['Forwarding']['local']); ?>&nbsp;</td>
		<td><?php echo h($forwarding['Forwarding']['source']); ?>&nbsp;</td>
		<td><?php echo h($forwarding['Forwarding']['destination']); ?>&nbsp;</td>
		<td><?php echo h($forwarding['Forwarding']['created']); ?>&nbsp;</td>
		<td><?php echo h($forwarding['Forwarding']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $forwarding['Forwarding']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $forwarding['Forwarding']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $forwarding['Forwarding']['id']), null, __('Are you sure you want to delete # %s?', $forwarding['Forwarding']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Forwarding'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Domains'), array('controller' => 'domains', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domain'), array('controller' => 'domains', 'action' => 'add')); ?> </li>
	</ul>
</div>
