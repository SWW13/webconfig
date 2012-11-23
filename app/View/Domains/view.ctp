<div class="page-header">
    <h1>
        <?= $domain['Domain']['domain'] ?>
    </h1>
</div>

<h2>Users</h2>
<?php if (!empty($domain['User'])): ?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($domain['User'] as $user): ?>
            <tr>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['name']; ?></td>
                    <td><?= $user['created']; ?></td>
                    <td><?= $user['modified']; ?></td>
                    <td>
                        <div class="btn-group">
                            <?= $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit', $user['id']), array('class' => 'btn')); ?>
                            <?php /*
                            <?= $this->Form->postLink('Delete', array('controller' => 'users', 'action' => 'delete', $user['id']), array('class' => 'btn'), 'Are you sure you want to delete \'' . $user['email'] . '\' ?'); ?>
                            */ ?>
                        </div>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<h2>Forwardings</h2>
<?php if (!empty($domain['User'])): ?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Source</th>
                <th>Destination</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($domain['Forwarding'] as $forwarding): ?>
            <tr>
                    <td><?= $forwarding['source']; ?></td>
                    <td><?= str_replace(' ', '<br/>', $forwarding['destination']); ?></td>
                    <td><?= $forwarding['created']; ?></td>
                    <td><?= $forwarding['modified']; ?></td>
                    <td>
                        <div class="btn-group">
                            <?= $this->Html->link('Edit', array('controller' => 'forwardings', 'action' => 'edit', $forwarding['id']), array('class' => 'btn')); ?>
                            <?= $this->Form->postLink('Delete', array('controller' => 'forwardings', 'action' => 'delete', $forwarding['id']), array('class' => 'btn'), 'Are you sure you want to delete \'' . $forwarding['source'] . '\' ?'); ?>
                        </div>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?= $this->Html->link('Add Forwarding', array('controller' => 'forwardings', 'action' => 'add', $domain['Domain']['id']), array('class' => 'btn btn-primary')); ?>