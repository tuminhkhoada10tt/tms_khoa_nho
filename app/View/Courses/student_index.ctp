<div class="col-lg-11">
    <h2>Danh mục khóa học đã tham gia</h2>
    <table class="table-hover table">
        <tr>
            <th>STT</th>
            <th><?php echo $this->Paginator->sort('chapter_id', 'Chuyên đề'); ?></th>
            <th><?php echo $this->Paginator->sort('name', 'Tên khóa'); ?></th>
            <th><?php echo $this->Paginator->sort('teacher_id', 'Tập huấn bởi'); ?></th>
            <th><?php echo $this->Paginator->sort('Chứng nhận'); ?></th>
        </tr>
        <?php
        $stt = 1;
        foreach ($courses1 as $course1):
            ?>
            <tr>
                <td><?php echo $stt++; ?></td>
                <td><?php echo $course1['Chapter']['name']; ?>&nbsp;</td>
                <td><?php echo h($course1['Course']['name']); ?>&nbsp;</td>

                <td>
                    <?php
                    echo $course1['Teacher']['name'];
//echo $this->Html->link($course1['Teacher']['name'], array('controller' => 'users', 'action' => 'view', $course1['Teacher']['id'])); 
                    ?>
                </td>
                <td><?php  ?>&nbsp;</td>

            </tr>
<?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
