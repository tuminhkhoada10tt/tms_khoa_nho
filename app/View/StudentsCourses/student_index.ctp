<?php //debug($students_courses);die;   ?>
<div class="panel panel-theme">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-thumb-tack"></i> Danh sách các khóa học đã tham gia</h3>
    </div>
    <div class="panel-body">

        <?php echo $this->Form->create(null, array('method' => 'post', 'action' => 'student_index', 'class' => 'course-finder-form', 'id' => 'CourseFilter')); ?>
        <div class="row">
            <div class="col-md-3 col-sm-3 subject">
                <?php echo $this->Form->input('field_id', array('label' => false, 'type' => 'select', 'options' => $fields, 'class' => "form-control subject", 'empty' => 'Chọn lĩnh vực')); ?>

            </div> 
            <div class="col-md-4 col-sm-4 subject">

                <?php echo $this->Form->input('chapter_id', array('label' => false, 'empty' => 'Chọn chuyên đề', 'type' => 'select', 'options' => $chapters, 'class' => "form-control subject")); ?>

            </div> 
            <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>
        </div>                     
        <?php echo $this->Form->end(); ?><!--//course-finder-form-->
        <?php
            $data = $this->Js->get('#CourseFilter')->serializeForm(array('isForm' => true, 'inline' => true));
            $this->Js->get('#CourseFilter')->event(
                    'submit', $this->Js->request(
                        array('students_courses'=>true,'action' => 'student_index'), array(
                        'update' => '#course_table',
                        'data' => $data,
                        'async' => true,
                        'dataExpression' => true,
                        'method' => 'POST'
                            )
                    )
            );
            echo $this->Js->writeBuffer();
            ?>

        <div class="table-responsive" id="course_table">                      
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khóa</th>
                        <th>Chuyên đề</th>
                        <th>Tập huấn bởi</th>
                        <th>Chứng nhận</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>

                <?php
                $stt = ($this->Paginator->param('page') - 1) * $this->Paginator->param('limit') + 1;
                foreach ($students_courses as $students_course):
                    ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $this->Html->link($students_course['Course']['name'], array('student' => true, 'controller' => 'courses', 'action' => 'view', $students_course['Course']['id']), array('escape' => false, 'class' => 'add-button fancybox.ajax')) ?></td>
                        <td><?php echo $students_course['Course']['Chapter']['name']; ?>&nbsp;</td>
                        <td><?php echo $students_course['Course']['Teacher']['name']; ?></td>
                        <td><?php
                            if ($students_course['StudentsCourse']['is_passed'] == 0)
                                echo "Chưa có chứng nhận";
                            else
                                echo "Đã có chứng nhận";
                            ?>
                        </td>
                        <td><?php
                            if ($students_course['StudentsCourse']['is_recieved'] == 0)
                                echo "Chưa cấp";
                            else
                                echo "Đã cấp";
                            ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </table>
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Trang {:page} của {:pages} trang, hiển thị {:current} của {:count} tất cả, bắt đầu từ {:start}, đến {:end}')
                ));
                ?>	</p>
                <?php
            echo $this->Paginator->pagination(array(
                'ul' => 'pagination'
            ));
            ?>
        </div>
    </div>
</div>
