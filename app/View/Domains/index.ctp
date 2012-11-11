<div class="page-header">
    <h1>
        Domains
        <small>Click on a domain to edit the mail accounts and forwards</small>
    </h1>
</div>

<?php if (!empty($domains)): ?>
<div class="row domainrow">
<?php
    $count = 0;
    foreach ($domains as $domain):
        $count++;
?>
    <a href="<?= $this->Html->url(array('action' => 'view', $domain['id'])) ?>">
        <div class="span4 domainbox">
            <div class="domainbox_inner">
                <h4><?= $domain['domain'] ?></h4>
            </div>
        </div>
    </a>
    
    <?php if($count % 3 == 0) echo '</div><div class="row domainrow">';?>
<?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert">
    no domains found...
</div>
<?php endif; ?>
