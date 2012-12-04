<div class="page-header">
    <h1>Add User</h1>
</div>

<?php
    echo $this->Form->create('User', array(
	'inputDefaults' => array(
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    ),
        'class' => 'form-horizontal'
	));
?>

<fieldset>
    <div class="control-group">
        <label for="DomainName" class="control-label">Domain</label>
        <div class="controls">
            <input id="DomainName" class="input-xlarge" value="<?= $domain['Domain']['domain']; ?>" maxlength="255" type="text" disabled/>
        </div>
    </div>
    
    <div class="control-group">
        <?= $this->Form->label('local', 'EMail', array('class' => 'control-label')); ?>
        <div class="controls">
            <div class="input-append required">
                <?= $this->Form->input('local', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                <span class="add-on">@<?= $domain['Domain']['domain'] ?></span>
            </div>
        </div>
    </div>
    
    <div class="control-group">
        <?= $this->Form->label('name', 'Name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('name', array('label' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    
    <div class="control-group">
        <?= $this->Form->label('password', 'Password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('password', array('label' => false, 'class' => 'input-xlarge', 'value' => '')); ?>
        </div>
    </div>
    
    
    <div class="form-actions">
        <?= $this->Form->submit('Add', array('class' => 'btn btn-primary', 'div' => false)) ?>
    </div>

    <?= $this->Form->end() ?>
</fieldset>