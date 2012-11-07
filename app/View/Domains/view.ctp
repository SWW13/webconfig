<div class="domains view">
<h2><?php  echo __('Domain'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($domain['Domain']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domain'); ?></dt>
		<dd>
			<?php echo h($domain['Domain']['domain']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($domain['Domain']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($domain['Domain']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Domain'), array('action' => 'edit', $domain['Domain']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Domain'), array('action' => 'delete', $domain['Domain']['id']), null, __('Are you sure you want to delete # %s?', $domain['Domain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Domains'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domain'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forwardings'), array('controller' => 'forwardings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forwarding'), array('controller' => 'forwardings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Forwardings'); ?></h3>
	<?php if (!empty($domain['Forwarding'])): ?>
	<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Domain Id'); ?></th>
		<th><?php echo __('Local'); ?></th>
		<th><?php echo __('Source'); ?></th>
		<th><?php echo __('Destination'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($domain['Forwarding'] as $forwarding): ?>
		<tr>
			<td><?php echo $forwarding['id']; ?></td>
			<td><?php echo $forwarding['domain_id']; ?></td>
			<td><?php echo $forwarding['local']; ?></td>
			<td><?php echo $forwarding['source']; ?></td>
			<td><?php echo $forwarding['destination']; ?></td>
			<td><?php echo $forwarding['created']; ?></td>
			<td><?php echo $forwarding['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forwardings', 'action' => 'view', $forwarding['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forwardings', 'action' => 'edit', $forwarding['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forwardings', 'action' => 'delete', $forwarding['id']), null, __('Are you sure you want to delete # %s?', $forwarding['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forwarding'), array('controller' => 'forwardings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($domain['User'])): ?>
	<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Domain Id'); ?></th>
		<th><?php echo __('Local'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($domain['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['domain_id']; ?></td>
			<td><?php echo $user['local']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
