<div class="page-header">
    <h1>Edit Admin</h1>
</div>

<?php
    echo $this->Form->create('Admin', array(
	'inputDefaults' => array(
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    ),
        'class' => 'form-horizontal'
	));
    
    echo $this->Form->hidden('id');
?>

<fieldset>
    <div class="control-group">
        <?= $this->Form->label('email', 'Email', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('email', array('label' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="control-group">
        <?= $this->Form->label('password', 'Password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?= $this->Form->input('password', array('label' => false, 'value' => '', 'type' => 'password', 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Domains</label>
        <div class="controls">
        <?php foreach($domains as $domain): ?>
            <label class="checkbox">
                <input name="data[Domain][][id]" value="<?= $domain['Domain']['id'] ?>" <?php if(in_array($domain['Domain']['domain'], $admin_domains)) echo 'checked'; ?> type="checkbox">
                <?= $domain['Domain']['domain'] ?>
            </label>
        <?php endforeach; ?>
        </div>
    </div>
    
    <div class="form-actions">
        <?= $this->Form->submit('Save', array('class' => 'btn btn-primary', 'div' => false)) ?>
    </div>
    <?= $this->Form->end() ?>
</fieldset>

<?php
pr($admin);
pr($admin_domains);
pr($domains);