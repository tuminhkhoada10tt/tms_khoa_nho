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
            <?php echo $this->element('Menu/teacher/header') ?>
            <!--//header-->

            <!-- ******NAV****** -->
            <nav class="main-nav" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button><!--//nav-toggle-->
                    </div><!--//navbar-header-->            
                    <div class="navbar-collapse collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active nav-item"><a href="index.html" >Trang chủ</a></li>
                            <li class="nav-item"><a href="index.html" >Lớp đã tập huấn</a></li>                            
                            <li class=" nav-item"><a href="index.html" >Lịch tập huấn</a></li>
                            <li class="nav-item"><a href="contact.html" >Liên hệ</a></li>
                        </ul><!--//nav-->
                    </div><!--//navabr-collapse-->
                </div><!--//container-->
            </nav><!--//main-nav-->

            <!-- ******CONTENT****** --> 
            <div class="content container">
                <div class="row cols-wrapper">

                    <div class="col-md-8">
                        <!-- WIDGET Thời khóa biểu hôm nay-->
                        <div class="panel panel-theme">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-calendar"></i> Lịch tập huấn hôm nay</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">                      
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên khóa học</th>
                                                <th>Chuyên đề</th>
                                                <th>Bắt đầu</th>
                                                <th>Địa điểm</th>
                                                <th>Tập huấn viên</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td><span class="label label-success">Approved</span></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td><span class="label label-danger">Rejected</span></td>
                                            </tr>
                                        </tbody>
                                    </table><!--//table-->
                                </div>
                            </div>
                        </div>
                        <!-- WIDGET CÁC KHÓA HỌC SẮP TỔ CHỨC-->
                        <div class="panel panel-theme">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-thumb-tack"></i> Lớp tập huấn sắp tổ chức của tôi</h3>
                            </div>
                            <div class="panel-body">
                                <form class="course-finder-form" action="#" method="get">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 subject">
                                            <select class="form-control subject">
                                                <option>Chọn lĩnh vực</option>
                                                <option>Phương pháp giảng dạy</option>
                                                <option>Ứng dụng Công nghệ thông</option>
                                                <option>Phát triển chương trình đào tạo </option>

                                            </select>
                                        </div> 
                                        <div class="col-md-4 col-sm-4 subject">
                                            <select class="form-control subject">
                                                <option>Chọn chuyên đề</option>
                                                <option>Phương pháp giảng dạy</option>
                                                <option>Ứng dụng Công nghệ thông</option>
                                                <option>Phát triển chương trình đào tạo </option>

                                            </select>

                                        </div> 
                                        <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>

                                    </div>                     
                                </form><!--//course-finder-form-->
                                <div class="table-responsive">                      
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên khóa học</th>
                                                <th>Chuyên đề</th>
                                                <th>Số buổi</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Có thể đăng ký thêm</th>
                                                <th>Giới hạn đăng ký</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td><span class="label label-success">Approved</span></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td><span class="label label-danger">Rejected</span></td>
                                            </tr>
                                        </tbody>
                                    </table><!--//table-->
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <!--WIDGET TIN TỨC - THÔNG BÁO-->
                            <div class="panel panel-theme">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class=" glyphicon glyphicon-bullhorn"></i> Thông báo từ hệ thống</h3>
                                </div>
                                <div class="panel-body">

                                    <ul>                      
                                        <li><a href="#">THÔNG BÁO LỊCH HỌC ĐỢT 2
                                                Lớp Cao học Lý luận và phương pháp dạy học bộ môn Ngữ văn khóa 2 - đợt 3
                                                <span class="badge">12/04/2014</span></a></li>
                                        <li><a href="#">THÔNG BÁO LỊCH HỌC ĐỢT 2
                                                Lớp Cao học Lý luận và phương pháp dạy học bộ môn Ngữ văn khóa 2 - đợt 3
                                                <span class="badge">12/04/2014</span></a></li>
                                        <li><a href="#">THÔNG BÁO LỊCH HỌC ĐỢT 2
                                                Lớp Cao học Lý luận và phương pháp dạy học bộ môn Ngữ văn khóa 2 - đợt 3
                                                <span class="badge">12/04/2014</span></a></li>
                                    </ul>

                                </div>

                            </div>
                            <!--WIDGET Thống kê-->
                            <div class="panel panel-theme">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class=" glyphicon glyphicon-bullhorn"></i> Thống kê</h3>
                                </div>
                                <div class="panel-body">

                                    <ul>                      
                                        <li><a href="#">Đã tham gia 5 lớp tập huấn
                                                <span class="badge">12/04/2014</span></a></li>
                                        <li><a href="#">Có 4 lớp đăng ký 3 đã đủ sĩ số
                                                <span class="badge">12/04/2014</span></a></li>
                                        <li><a href="#">Lớp học gần nhất là XYZ vào buổi sáng ngày 12/04/2014 tại
                                                <span class="badge">12/04/2014</span></a></li>
                                        <li><a href="#">Lần đăng nhập cuối
                                                <span class="badge">12/04/2014</span></a></li>
                                    </ul>

                                </div>

                            </div>
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

