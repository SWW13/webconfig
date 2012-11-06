<div class="domains form">
<?php echo $this->Form->create('Domain'); ?>
	<fieldset>
		<legend><?php echo __('Add Domain'); ?></legend>
	<?php
		echo $this->Form->input('domain');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Domains'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Forwardings'), array('controller' => 'forwardings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forwarding'), array('controller' => 'forwardings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
