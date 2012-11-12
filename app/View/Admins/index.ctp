<div class="page-header">
    <h1>
        Admins
    </h1>
</div>

<?php if (!empty($admins)): ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>EMail</th>
            <th>Domains</th>
            <th>Admin</th>
            <th>Modified</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($admins as $admin): ?>
        <tr>
                <td><?= $admin['Admin']['email']; ?></td>
                <td>
                    <?php foreach($admin['Domain'] as $domain): ?>
                        <?= $domain['domain'] . '<br/>'; ?>
                    <?php endforeach; ?>
                </td>
                <td><?= $admin['Admin']['admin'] ? '<b>Server Admin</b>' : 'Admin' ?></td>
                <td><?= $admin['Admin']['created']; ?></td>
                <td><?= $admin['Admin']['modified']; ?></td>
                <td>
                    <div class="btn-group">
                        <?= $this->Html->link('Edit', array('action' => 'edit', $admin['Admin']['id']), array('class' => 'btn')); ?>
                        <?= $this->Form->postLink('Delete', array('action' => 'delete', $admin['Admin']['id']), array('class' => 'btn'), 'Are you sure you want to delete \'' . $admin['Admin']['email'] . '\' ?'); ?>
                    </div>
                </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?= $this->Html->link('Add Admin', array('controller' => 'admins', 'action' => 'add', $admin['Admin']['id']), array('class' => 'btn btn-primary')); ?>