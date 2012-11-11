<div class="page-header">
    <h1>Add Domain</h1>
</div>

<?php
    echo $this->Form->create('Domain', array(
	'inputDefaults' => array(
	    'div' => 'control-group',
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    ),
        'class' => 'form-horizontal'
	));
?>

<fieldset>
    <div class="control-group">
        <?= $this->Form->label('domain', 'Domain', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('domain', array('label' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="form-actions">
        <?= $this->Form->submit('Add', array('class' => 'btn btn-primary', 'div' => false)) ?>
    </div>

    <?= $this->Form->end() ?>
</fieldset>