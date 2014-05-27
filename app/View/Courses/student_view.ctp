<div class="col-lg-12 content-right">
    <div class="row">
        <h3 class="page-header">Khóa học: <?php echo $course['Course']['name'] ?> </h3>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li ><a data-toggle="tab" href="#tab_2-4">Lịch học</a></li>
                    <li class=""><a data-toggle="tab" href="#tab_2-5">Tài liệu</a></li>

                    <li class=""><a data-toggle="tab" href="#tab_2-2">Thông tin</a></li>
                    <li class="active"><a data-toggle="tab" href="#tab_1-1">Nội dung</a></li>

                </ul>
                <div class="tab-content">
                    <div id="tab_1-1" class="tab-pane active">
                        <div class="noi_dung" >
                            <img alt="" class="pull-left"  style="padding-right: 10px; width: 500px;"src="/files/course/image/<?php echo $course['Course']['image_path'] . '/' . $course['Course']['image']; ?>">

                            <p><?php echo $course['Course']['decription']; ?></p>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div id="tab_2-2" class="tab-pane">
                        <table class="table table-condensed">

                            <tbody style="font-size: 15px;">
                                <tr>
                                    <td>Tập huấn bởi</td>
                                    <td><?php if (!empty($course['Teacher']['HocHam']['name'])): ?>

                                            <?php echo $course['Teacher']['HocHam']['name'] . ' '; ?>

                                        <?php endif; ?>
                                        <?php if (!empty($course['Teacher']['HocVi']['name'])): ?>                                             
                                            <?php echo $course['Teacher']['HocVi']['name'] . ' '; ?>

                                        <?php endif; ?>
                                        <?php echo  $course['Teacher']['name'];
                                        //echo $this->Html->link($course['Teacher']['name'], array('fields_manager' => true, 'controller' => 'users', 'action' => 'view', $course['Teacher']['id'])) ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Số buổi</td>
                                    <td><?php echo count($course['CoursesRoom'] ); ?></td>
                                </tr>
                                <tr>
                                    <td>Số lượng đăng ký tối đa</td> 
                                    <td><?php echo $course['Course']['max_enroll_number']; ?></td>
                                </tr>
                                <tr>
                                    <td>Hạn đăng ký</td> 
                                    <td>
                                        <span class="text-red"><?php echo $course['Course']['enrolling_expiry_date']; ?></span>
                                    </td>
                                </tr>
                                <tr><td>Đã xuất bản</td><td><?php echo $course['Course']['is_published']; ?></td></tr>
                                <tr><td> Tình trạng</td><td><?php echo $course['Course']['status']; ?></td></tr>

                                <tr>
                                    <td>Chuyên đề</td>
                                    <td>                 
                                        <?php echo  $course['Chapter']['name'];
                                        //echo $this->Html->link($course['Chapter']['name'], array('controller' => 'chapters', 'action' => 'view', $course['Chapter']['id'])); ?>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </div><!-- /.tab-pane -->

                    <div id="tab_2-4" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            
                                            <div class="table-responsive">
                                                <table class="table table-hover table-condensed">
                                                    <thead>
                                                        <tr><th>STT</th><th>Tên</th><th>Bắt đầu</th><th>Địa điểm</th></tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $stt = 0;
                                                        foreach ($course['CoursesRoom'] as $buoi):
                                                            ?>

                                                            <tr>
                                                                <td><?php echo ++$stt; ?></td>
                                                                <td><?php echo $buoi['title']; ?></td>
                                                                <td><?php $start= new DateTime($buoi['start']); echo $start->format('H:i'); echo " Giờ, ";echo"Ngày: ";echo $start->format('d-m-Y');?></td>
                                                                <td><?php echo $buoi['room']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div id="tab_2-5" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4><?php echo $course['Teacher']['name'] ?></h4>
                                            <span class="glyphicon glyphicon-envelope"></span> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-content -->


            </div>
        </div>

    </div>

    <hr>



</div>
