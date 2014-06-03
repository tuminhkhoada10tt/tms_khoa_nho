<div class="panel panel-theme">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-calendar"></i> Lịch học hôm nay của tôi</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">                      
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 25%">Tên khóa học</th>
                        <th>Chuyên đề</th>
                        <th>Bắt đầu</th>
                        <th>Địa điểm</th>
                        <th>Tập huấn viên</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //debug($courses_today);die;
                    $stt = ($this->Paginator->param('page') - 1) * $this->Paginator->param('limit') + 1;
                    ?>
<?php foreach ($courses_today as $course_today): ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $this->Html->link($course_today['Course']['name'], array('student' => true, 'controller' => 'courses', 'action' => 'view', $course_today['Course']['id']), array('escape' => false, 'class' => 'add-button fancybox.ajax'))
    ?></td>
                            <td><?php echo $course_today['Course']['Chapter']['name']; ?></td>
                            <td><?php $start= new DateTime($course_today['CoursesRoom']['start']);echo " Giờ: "; echo $start->format('H:i'); echo", Ngày: ";echo $start->format('d/m/Y');?></td>
                            <td><?php echo $course_today['Room']['name']; ?></td>
                            <td><?php echo $course_today['Course']['Teacher']['name']; ?></td>
                        </tr>
<?php endforeach; ?>
                </tbody>
            </table><!--//table-->
        </div>
    </div>
</div>