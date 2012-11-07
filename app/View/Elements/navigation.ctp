<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?= $this->Html->url('/') ?>">webconfig</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="<?= $this->Html->url('/domains') ?>">Domains</a></li>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <ul class="nav">
                    <li><a href="<?= $this->Html->url('/admins/logout') ?>"><i class="icon-off icon-white"></i> logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>