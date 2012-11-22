<div class="page-header">
    <h1>Add Admin</h1>
</div>

<?php
    echo $this->Form->create('Admin', array(
	'inputDefaults' => array(
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    ),
        'class' => 'form-horizontal'
	));
?>

<fieldset>
    <div class="control-group">
        <?= $this->Form->label('email', 'EMail', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('email', array('label' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="control-group">
        <?= $this->Form->label('password', 'Password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('password', array('label' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    
    <div class="form-actions">
        <?= $this->Form->submit('Add', array('class' => 'btn btn-primary', 'div' => false)) ?>
    </div>

    <?= $this->Form->end() ?>
</fieldset>