<?php if($rowcount>0){?>
<div class="panel panel-theme">
    <div class="panel-heading">
        <h3 class="panel-title"><i class=" glyphicon glyphicon-bullhorn"></i> Khóa học mới đăng kí</h3>
    </div>
    <div class="panel-body">


        <div class="table-responsive">                      
            <table class="table table-condensed">
                <thead>
                <th>STT</th><th>Tên khóa học</th>
                </thead>
                <tbody>
                    <?php $stt = ($this->Paginator->param('page') - 1) * $this->Paginator->param('limit') + 1; ?>
                    <?php foreach ($courses1 as $course1): ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $this->Html->link($course1['Course']['name'], array('student' => true, 'controller' => 'courses', 'action' => 'view', $course1['Course']['id']), array('escape' => false, 'class' => 'add-button fancybox.ajax')) ?></td>
                             <td><a href="/students_courses/canceled/<?php echo $course1['Course']['id']?>"><span class="label label-danger">Hủy</span></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table><!--//table-->
        </div>

    </div>
</div>
<?php }else {?>
<div class="panel panel-theme">
    <div class="panel-heading">
        <h3 class="panel-title"><i class=" glyphicon glyphicon-bullhorn"></i> Bạn chưa đăng kí khóa học mới nào.</h3>
    </div>
   </div>
<?php } ?>
