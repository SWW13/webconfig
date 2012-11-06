<div class="forwardings view">
<h2><?php  echo __('Forwarding'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forwarding['Forwarding']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domain'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forwarding['Domain']['id'], array('controller' => 'domains', 'action' => 'view', $forwarding['Domain']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Local'); ?></dt>
		<dd>
			<?php echo h($forwarding['Forwarding']['local']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($forwarding['Forwarding']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo h($forwarding['Forwarding']['destination']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forwarding['Forwarding']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forwarding['Forwarding']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forwarding'), array('action' => 'edit', $forwarding['Forwarding']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forwarding'), array('action' => 'delete', $forwarding['Forwarding']['id']), null, __('Are you sure you want to delete # %s?', $forwarding['Forwarding']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forwardings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forwarding'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domains'), array('controller' => 'domains', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domain'), array('controller' => 'domains', 'action' => 'add')); ?> </li>
	</ul>
</div>
