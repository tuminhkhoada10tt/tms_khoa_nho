<?php echo $this->Html->script('jquery.shorten.1.0'); ?>
<div class="col-lg-12 content-right">

    <div class="row">
        <h3 class="page-header">Khóa học: <?php echo $course['Course']['name'] ?> </h3>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class=""><a data-toggle="tab" href="#tab_2-4">Lịch học</a></li>
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
                                        <?php echo $this->Html->link($course['Teacher']['name'], array('fields_manager' => true, 'controller' => 'users', 'action' => 'view', $course['Teacher']['id'])) ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Số buổi</td>
                                    <td><?php echo $course['Course']['session_number']; ?></td>
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
                                        <?php echo $this->Html->link($course['Chapter']['name'], array('controller' => 'chapters', 'action' => 'view', $course['Chapter']['id'])); ?>
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
                                            
                                            <?php
                                            //echo $this->Html->script('do_schedule',array('inline'=>false));
                                            echo $this->element('Common/do_schedule', array('course_id'=>$course['Course']['id']));
                                            ?>
                                            <?php echo $this->element('Widgets/fields_manager/schedule'); ?>
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
                                            <h4><a href="#"><?php echo $course['Teacher']['name'] ?></a></h4>
                                            <span class="glyphicon glyphicon-envelope"></span> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-content -->


            </div>
            <div class="btn-toolbar pull-right">
                <?php echo $this->Html->link('SỬA', '/fields_manager/courses/edit/' . $course['Course']['id'], array('class' => 'btn btn-info')); ?>
                <?php echo $this->Html->link('HỦY', '#', array('class' => 'btn btn-warning')); ?>
                <?php echo $this->Html->link('XÓA', '#', array('class' => 'btn btn-danger')); ?>
            </div>
        </div>

    </div>

    <hr>



</div>

<script>

    $('.noi_dung').shorten({
        showChars: '4000',
        moreText: 'Đọc thêm',
        lessText: 'Đóng lại'
    });
</script>