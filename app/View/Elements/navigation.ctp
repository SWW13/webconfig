<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?= $this->Html->url('/') ?>">webconfig</a>
            
            <?php if(isset($admin)): ?>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li id="fat-menu" class="dropdown <?= $this->here == $this->Html->url('/domains') ? 'active' : ''; ?>">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            Domains
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                            <li><a href="<?= $this->Html->url('/domains') ?>"><i class="icon-list-alt"></i> overview</a></li>
                            
                            <?php if(count($domains) > 0): ?>
                            <li class="divider"></li>
                            <?php foreach($domains as $domain): ?>
                                <?php $domain = isset($domain['Domain']) ? $domain['Domain'] : $domain; ?>
                                <li>
                                    <a href="<?= $this->Html->url(array('controller' => 'domains', 'action' => 'view', $domain['id'])) ?>">
                                        <?= $domain['domain'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div class="nav-collapse collapse pull-right">
                <ul class="nav">
                    <li id="fat-menu" class="dropdown">
                      <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                          <?= $admin['email'] ?>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                        <li><a href="<?= $this->Html->url('/admins/settings') ?>"><i class="icon-wrench"></i> settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= $this->Html->url('/admins/logout') ?>"><i class="icon-off"></i> logout</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
