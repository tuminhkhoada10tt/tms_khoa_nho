<div class="col-lg-12 content-right">
    <?php
    $this->Html->addCrumb('Chuyên đề', '/fields_manager/chapters');
    $this->Html->addCrumb('Thông tin chuyên đề/' . $chapter['Chapter']['name']);
    ?>
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#thong_tin_chung">Thông tin</a></li>
                <li class=""><a data-toggle="tab" href="#tai_lieu">Tài liệu</a></li>
            </ul>
            <div class="tab-content">
                <div id="thong_tin_chung" class="tab-pane active">
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> Ngày tạo:<?php echo h($chapter['Chapter']['created']); ?></span>
                        <h3 class="timeline-header"><?php echo h($chapter['Chapter']['name']); ?></h3>
                        <div class="timeline-body">
                            <?php echo ($chapter['Chapter']['decriptions']); ?>
                        </div>
                        <div class="timeline-footer">
                            <?php
                            echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array('action' => 'edit', $chapter['Chapter']['id']), array('escape' => false,
                                'class' => 'add-button btn btn-primary btn-xs fancybox.ajax', 'role' => 'button', 'div' => false));
                            ?>
                            <?php echo $this->Form->postLink('<span class="fa fa-trash-o"></span>', array('fields_manager' => false, 'controller' => 'chapters', 'action' => 'delete', $chapter['Chapter']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false), __('Bạn chắc xóa chuyên đề %s?', $chapter['Chapter']['name'])); ?>
                        </div>
                    </div>
                </div>

                <div id="tai_lieu" class="tab-pane">
                    <?php if (empty($chapter['TaiLieu'])): ?>
                        Thêm tài liệu:
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Tên file
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $stt = 0;
                                    foreach ($chapter['TaiLieu'] as $tailieu):
                                        ?>
                                        <tr>
                                            <td><?php echo ++$stt ?></td>
                                            <td><?php echo $this->Html->link($tailieu['attachment'], array('fields_manager'=>false,'action' => 'download', $tailieu['id'])); ?></td>
                                        </tr>
    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>
                        <?php //    debug($chapter['TaiLieu']); ?>
<?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>