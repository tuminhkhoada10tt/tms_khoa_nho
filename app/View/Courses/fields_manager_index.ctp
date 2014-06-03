
<?php /* Course */ ?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3>Danh mục khóa học</h3>
            <div class="box-tools">

            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table-hover table">
                <tr>
                    <th>STT</th>
                    <th><?php echo $this->Paginator->sort('name', 'Tên khóa'); ?></th>
                    <th><?php echo $this->Paginator->sort('chapter_id', 'Chuyên đề'); ?></th>

                    <th><?php echo $this->Paginator->sort('teacher_id', 'Tập huấn bởi'); ?></th>
                    <th><?php echo $this->Paginator->sort('max_enroll_number', 'Đăng ký tối đa'); ?></th>
                    <th><?php echo $this->Paginator->sort('session_number', 'Số buổi'); ?></th>
                    <th><?php echo $this->Paginator->sort('is_published', 'Xuất bản'); ?></th>
                    <th><?php echo $this->Paginator->sort('enrolling_expiry_date', 'Hết hạn đăng ký'); ?></th>
                    <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>

                    <th class="actions">Thao tác</th>
                </tr>
                <?php $stt = ($this->Paginator->param('page') - 1) * $this->Paginator->param('limit') + 1; ?>

                <?php foreach ($courses as $course): ?>
                    <tr>
                        <th><?php echo $stt++; ?></th>

                        <td>
                            <?php echo $this->Html->link($course['Course']['name'], array('fields_manager'=>true,'controller' => 'courses', 'action' => 'view', $course['Course']['id'])); ?>


                        <td>
                            <?php echo $this->Html->link($course['Chapter']['name'], array('controller' => 'chapters', 'action' => 'view', $course['Chapter']['id'])); ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link($course['Teacher']['name'], array('controller' => 'users', 'action' => 'view', $course['Teacher']['id'])); ?>
                        </td>
                        <td><?php echo h($course['Course']['max_enroll_number']); ?>&nbsp;</td>
                        <td><?php echo h($course['Course']['session_number']); ?>&nbsp;</td>
                        <td><?php echo h($course['Course']['is_published']); ?>&nbsp;</td>
                        <td><?php echo h($course['Course']['enrolling_expiry_date']); ?>&nbsp;</td>
                        <td><?php echo h($course['Course']['created']); ?>&nbsp;</td>

                        <td class="actions">

                            <?php echo $this->Html->link('<button type="button" class="btn btn-info">
  <span class="glyphicon glyphicon-edit"></span></button>', array('action' => 'edit', $course['Course']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<button type="button" class="btn btn-warning">
  <span class="glyphicon glyphicon-trash"></span></button>', array('action' => 'delete', $course['Course']['id']), array('escape' => false), __('Bạn có chắc xóa khóa học # %s?', $course['Course']['name'] . ' - ' . $course['Chapter']['name'])); ?>
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
        <div class="box-footer" style="text-align: right;">
            <?php echo $this->Html->link('Thêm mới', array('action' => 'add'), array('class' => 'btn btn-success')); ?>

        </div>
    </div>
</div>


