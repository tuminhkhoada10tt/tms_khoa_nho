<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>
        <?php echo $this->element('Common/header_tag');?>

    </head> 

    <body class="home-page">
        <div class="wrapper">
            <!-- ******HEADER****** --> 
            <!--//header-->
            <?php echo $this->element('Menu/student/header') ?>
            <!-- ******NAV****** -->
            <?php echo $this->element('Menu/student/nav') ?>
            <!--//main-nav-->

            <!-- ******CONTENT****** --> 
            <div class="content container">
                <div class="row cols-wrapper">

                    <div class="col-md-8">
                        <!-- WIDGET Thời khóa biểu hôm nay-->
                        <?php echo $this->element('Widgets/student/today_schedule') ?>
                        <!-- WIDGET CÁC KHÓA HỌC SẮP TỔ CHỨC-->
                        <?php echo $this->element('Common/new_course') ?>


                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <!--WIDGET TIN TỨC - THÔNG BÁO-->
                            <?php echo $this->element('Widgets/student/news')?>
                            <!--WIDGET Thống kê-->
                            <?php echo $this->element('Widgets/student/statistics')?>
                        </div>
                    </div> 

                </div><!--//cols-wrapper-->

            </div><!--//content-->

        </div><!--//wrapper-->

        <!-- ******FOOTER****** --> 
        <footer class="footer">

            <div class="bottom-bar">
                <div class="container">
                    <div class="row">
                        <small class="copyright col-md-6 col-sm-12 col-xs-12">Phát triển bởi Trung tâm Hỗ trợ - Phát triển Dạy & Học năm 2014</small>
                        <ul class="social pull-right col-md-6 col-sm-12 col-xs-12">
                            <li><a href="#" ><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" ><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" ><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#" ><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" ><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" ><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#" ><i class="fa fa-skype"></i></a></li> 
                            <li class="row-end"><a href="#" ><i class="fa fa-rss"></i></a></li>
                        </ul><!--//social-->
                    </div><!--//row-->
                </div><!--//container-->
            </div><!--//bottom-bar-->
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

