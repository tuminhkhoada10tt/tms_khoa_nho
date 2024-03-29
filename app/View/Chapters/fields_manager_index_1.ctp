<div class="col-md-10">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Danh mục chuyên đề</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>STT</th>
                            <th><?php echo $this->Paginator->sort('name', 'Tên'); ?></th>
                            <th><?php echo $this->Paginator->sort('field_id', 'Lĩnh vực'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Ngày tạo'); ?></th>
                            <th class="actions">Thao tác</th>
                        </tr>
                        <?php $stt = ($this->Paginator->param('page') - 1) * $this->Paginator->param('limit') + 1; ?>
                        <?php foreach ($chapters as $chapter): ?>
                            <tr>
                                <th><?php echo $stt++; ?></th>
                                <td><?php echo $this->Html->link($chapter['Chapter']['name'], array('action' => 'view', $chapter['Chapter']['id'])); ?></td>
                                <td>
                                    <?php echo $this->Html->link($chapter['Field']['name'], array('controller' => 'fields', 'action' => 'view', $chapter['Field']['id'])); ?>
                                </td>
                                <td><?php echo h($chapter['Chapter']['created']); ?>&nbsp;</td>
                                <td class="actions">

                                    <?php echo $this->Html->link('<button type="button" class="btn btn-info">
  <span class="glyphicon glyphicon-edit"></span></button>', array('action' => 'edit', $chapter['Chapter']['id']), array('escape' => false)); ?>
                                    <?php echo $this->Form->postLink('<button type="button" class="btn btn-warning">
  <span class="glyphicon glyphicon-trash"></span></button>', array('action' => 'delete', $chapter['Chapter']['id']), array('escape' => false), __('Bạn có chắc xóa chuyên đề # %s?', $chapter['Chapter']['name'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

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
            </div><!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
    

