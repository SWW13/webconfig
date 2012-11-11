<div class="page-header">
    <h1>
        Domains
        <small>Click on a domain to edit the mail accounts and forwards</small>
    </h1>
</div>

<?php if (!empty($domains)): ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Domain</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($domains as $domain): ?>
        <tr>
                <td><?= $domain['Domain']['domain']; ?></td>
                <td><?= $domain['Domain']['created']; ?></td>
                <td><?= $domain['Domain']['modified']; ?></td>
                <td>
                    <div class="btn-group">
                        <?= $this->Html->link('View', array('action' => 'view', $domain['Domain']['id']), array('class' => 'btn')); ?>
                        <?= $this->Html->link('Edit', array('action' => 'edit', $domain['Domain']['id']), array('class' => 'btn')); ?>
                        <?php /*
                        <?= $this->Form->postLink('Delete', array('action' => 'delete', $domain['Domain']['id']), array('class' => 'btn'), 'Are you sure you want to delete \'' . $domain['Domain']['domain'] . '\' ?'); ?>
                        */ ?>
                    </div>
                </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?= $this->Html->link('Add Doamin', array('controller' => 'domains', 'action' => 'add', $domain['Domain']['id']), array('class' => 'btn btn-primary')); ?>