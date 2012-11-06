<div class="forwardings form">
<?php echo $this->Form->create('Forwarding'); ?>
	<fieldset>
		<legend><?php echo __('Edit Forwarding'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain_id');
		echo $this->Form->input('local');
		echo $this->Form->input('source');
		echo $this->Form->input('destination');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Forwarding.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Forwarding.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forwardings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Domains'), array('controller' => 'domains', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domain'), array('controller' => 'domains', 'action' => 'add')); ?> </li>
	</ul>
</div>
