<div class="panel panel-theme">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-thumb-tack"></i> Danh sách các khóa đã tham gia</h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Field', array('id' => 'FieldSearchForm', 'method' => 'post', 'action' => 'student_courses_attended', 'class' => 'course-finder-form')); ?>
        <div class="row">
            <div class="col-md-3 col-sm-3 subject">
                <?php echo $this->Form->input('field_id', array('label' => false, 'name' => 'field_name', 'type' => 'select', 'options' => $fields, 'class' => "form-control subject", 'empty' => 'Chọn lĩnh vực')); ?>
            </div> 
            <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>
        </div>                     
        <?php echo $this->Form->end(); ?>
        <?php
        $data = $this->Js->get('#FieldSearchForm')->serializeForm(array('isForm' => true, 'inline' => true));
        $this->Js->get('#FieldSearchForm')->event(
                'submit', $this->Js->request(
                        array('action' => 'student_courses_attended'), array(
                    'update' => '#aftersearch',
                    'data' => $data,
                    'async' => true,
                    'dataExpression' => true,
                    'method' => 'POST'
                        )
                )
        );
        echo $this->Js->writeBuffer();
        ?>
        <div class="table-responsive" id="aftersearch">                      
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
                $stt = 1;
                foreach ($courses_attended as $course_attended):
                    ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $this->Html->link($course_attended['Course']['name'], array('student' => true, 'controller' => 'courses', 'action' => 'view', $course_attended['Course']['id']), array('escape' => false, 'class' => 'add-button fancybox.ajax'));
                    ?>&nbsp;

                        </td>
                        <td><?php echo $course_attended['Course']['Chapter']['name']; ?>&nbsp;</td>

                        <td><?php echo $course_attended['Course']['Teacher']['name']; ?></td>

                        <td><?php
                            if ($course_attended['StudentsCourse']['is_passed'] == 1)
                                echo "Đã có chứng nhận";
                            else
                                echo "Chưa có chứng nhận";
                            ?></td>

                        <td><?php
                            if ($course_attended['StudentsCourse']['is_recieved'] == 1)
                                echo "Đã cấp";
                            else
                                echo "Chưa cấp";
                            ?></td>

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
