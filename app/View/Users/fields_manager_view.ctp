<?php //debug($user);    ?>
<section class="content invoice">    

    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Thông tin tập huấn viên:<?php echo $user['User']['name']; ?>
                <small class="pull-right">Ngày tạo: <?php echo $user['User']['created']; ?></small>
            </h2>                            
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-md-6 invoice-col">
            <div class="col-md-3">
                <img alt="User Image" class="img-circle" src="/files/">
            </div>
            <!-- Primary tile -->
            <div class="col-md-3">
                <div class="box box-solid bg-light-blue">
                    <div class="box-header">
                        <h3 class="box-title"> Thông tin cơ bản</h3>
                    </div>
                    <div class="box-body">
                        Họ tên: <?php echo $user['User']['name']; ?><br>
                        Ngày sinh: <?php echo $user['User']['birthday']; ?><br>
                        Nơi sinh: <?php echo $user['User']['birthplace']; ?><br>
                        Học hàm: <?php echo $user['HocHam']['name']; ?><br>
                        Học vị: <?php echo $user['HocVi']['name']; ?><br>
                        Số điện thoại: <?php echo $user['User']['phone_number']; ?><br>
                        Email: <?php echo $user['User']['email']; ?>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div><!-- /.col -->
        <div class="col-sm-6 invoice-col">
            <div class="box box-solid bg-navy">
                <div class="box-header">
                    <h3 class="box-title"> Thông tin hoạt động</h3>
                </div>
                <div class="box-body">
                    Username: <strong><?php echo $user['User']['username']; ?></strong><br>

                    Lần đăng nhập cuối: <?php echo $user['User']['last_login']; ?><br>
                    Tình trạng: <?php echo $user['User']['activated']; ?><br>
                    <b>Số lớp đã hoàn thành:</b> <?php echo $user['User']['completedCourse']; ?><br>
                    <b>Số lớp chưa hoàn thành:</b> <?php echo $user['User']['uncompletedCourse']; ?><br>
                    <b>Số lớp đang đăng ký:</b> <?php echo $user['User']['registeringCourse']; ?><br/>
                    <b>Số lớp đã hủy:</b> <?php echo $user['User']['cancelledCourse']; ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->


    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>  
            <button style="margin-right: 5px;" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate PDF</button>
        </div>
    </div>
</section>