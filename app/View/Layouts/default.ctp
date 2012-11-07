<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?> - webconfig
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');
        echo $this->Html->css('bootstrap.min');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <style>body { padding-top: 60px; }</style>
    </head>
    <body>
        <?= $this->element('navigation'); ?>
        
        <div class="container">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>

        <?php echo $this->element('sql_dump'); ?>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <?= $this->Html->script('bootstrap.min'); ?>
    </body>
</html>