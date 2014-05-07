<?php

$cakeDescription = __d('cake_dev', 'Trang Quản lý Thông tin Bổ nhiệm Phòng Hành chính - Tổ chức');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('menu');
        echo $this->Html->css('/jquery-ui-1.10.3.custom/css/redmond/jquery-ui-1.10.3.custom.min');
        echo $this->Html->css('Usermgmt.umstyle');
        echo $this->Html->script('jquery');
        echo $this->Html->script('/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min');
        echo $this->Html->css('cake.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
            </div>
            <div id="menu">
                <?php //echo $this->element('menu'); ?>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
                <?php
                echo $this->Html->link(
                        $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)
                );
                ?>
            </div>
        </div>
    </body>
</html>
