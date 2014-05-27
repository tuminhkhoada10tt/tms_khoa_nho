<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>
        <title><?php echo Configure::read('System.name') ?></title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="<?php echo Configure::read('System.name') ?>" content="">    
        <link rel="shortcut icon" href="favicon.ico">  
        <?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'); ?>
        <!-- Global CSS -->
        <?php echo $this->Html->css('/user/plugins/bootstrap/css/bootstrap.min') ?>
        <!-- Plugins CSS -->    
        <?php echo $this->Html->css('/user/plugins/font-awesome/css/font-awesome') ?>
        <?php echo $this->Html->css('/user/plugins/flexslider/flexslider') ?>
        <?php echo $this->Html->css('/user/plugins/pretty-photo/css/prettyPhoto') ?>
        <?php echo $this->Html->css('/user/plugins/bootstrap/css/bootstrap.min') ?>
        <!-- Theme CSS -->  
        <?php echo $this->Html->css('/user/css/styles') ?>
        <?php
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="home-page">
        <div class="wrapper">
            <!-- ******HEADER****** --> 
            <?php echo $this->element('Menu/guest/header'); ?>
            <!--//header-->

            <!-- ******NAV****** -->
            <?php echo $this->element('Menu/guest/nav'); ?>
            <!--//main-nav-->

            <!-- ******CONTENT****** --> 
            <div class="content container">
                <div class="row">
                    
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                </div>
                <div class="row cols-wrapper">                 
                    <?php echo $this->fetch('content'); ?>

                </div><!--//cols-wrapper-->

            </div><!--//content-->
        </div><!--//wrapper-->

        <!-- ******FOOTER****** --> 
        <footer class="footer">

            <div class="bottom-bar">
                <div class="container">
                    <div class="row">
                        <small class="copyright col-md-6 col-sm-12 col-xs-12">Phát triển bởi Trung tâm Hỗ trợ - Phát triển Dạy & Học năm 2014</small>

                    </div><!--//row-->
                </div><!--//container-->
            </div><!--//bottom-bar-->
            <!--WIDGET Ý KIẾN ĐÓNG GÓP-->

        </footer><!--//footer-->
        <!-- Javascript -->          
        <?php echo $this->Html->script('/user/plugins/jquery-1.10.2.min'); ?>
        <?php echo $this->Html->script('/user/plugins/jquery-migrate-1.2.1.min'); ?>
        <?php echo $this->Html->script('/user/plugins/bootstrap/js/bootstrap.min'); ?>
        <?php echo $this->Html->script('/user/plugins/bootstrap-hover-dropdown.min'); ?>
        <?php echo $this->Html->script('/user/plugins/back-to-top'); ?>
        <?php echo $this->Html->script('/user/plugins/jquery-placeholder/jquery.placeholder'); ?>
        <?php echo $this->Html->script('/user/plugins/pretty-photo/js/jquery.prettyPhoto'); ?>
        <?php echo $this->Html->script('/user/plugins/flexslider/jquery.flexslider-min'); ?>
        <?php echo $this->Html->script('/user/plugins/jflickrfeed/jflickrfeed.min'); ?>
        <?php echo $this->Html->script('/user/js/main'); ?>                
    </body>
</html> 

