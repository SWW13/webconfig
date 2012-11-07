<div class="page-header">
    <h1>
        Domains
        <small>Click on a domain to edit the mail accounts and forwards</small>
    </h1>
</div>

<div class="row domainrow">
<?php
    $count = 0;
    foreach ($domains as $domain):
        $count++;
?>
    <a href="<?= $this->Html->url(array('action' => 'view', $domain['Domain']['id'])) ?>">
        <div class="span4 domainbox">
            <div class="domainbox_inner">
                <h4><?= $domain['Domain']['domain'] ?></h4>
            </div>
        </div>
    </a>
    
    <?php if($count % 3 == 0) echo '</div><div class="row domainrow">';?>
<?php endforeach; ?>
</div>