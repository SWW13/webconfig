<div class="domains form">
<?php echo $this->Form->create('Domain'); ?>
	<fieldset>
		<legend><?php echo __('Edit Domain'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Domain.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Domain.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Domains'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Forwardings'), array('controller' => 'forwardings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forwarding'), array('controller' => 'forwardings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
