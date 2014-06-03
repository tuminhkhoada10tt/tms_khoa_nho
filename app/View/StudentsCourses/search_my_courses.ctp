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