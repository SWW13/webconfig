<div class="forwardings form">
<?php echo $this->Form->create('Forwarding'); ?>
	<fieldset>
		<legend><?php echo __('Add Forwarding'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Forwardings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Domains'), array('controller' => 'domains', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domain'), array('controller' => 'domains', 'action' => 'add')); ?> </li>
	</ul>
</div>
