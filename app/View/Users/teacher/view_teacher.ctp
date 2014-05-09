<?php //debug($user);  ?>
<section class="content invoice">    

    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Thông tin tập huấn viên:<?php echo $user['User']['name']; ?>
                <small class="pull-right">Ngày tạo: <?php echo $user['User']['created']; ?></small>
            </h2>                            
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-md-6 invoice-col">
            <!-- Primary tile -->
            <div class="box box-solid bg-light-blue">
                <div class="box-header">
                    <h3 class="box-title"> Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    Họ tên: <?php echo $user['User']['name']; ?><br>
                    Ngày sinh: <?php echo $user['User']['birthday']; ?><br>
                    Nơi sinh: <?php echo $user['User']['birthplace']; ?><br>
                    Học hàm: <?php echo $user['HocHam']['name']; ?><br>
                    Học vị: <?php echo $user['HocVi']['name']; ?><br>
                    Số điện thoại: <?php echo $user['User']['phone_number']; ?><br>
                    Email: <?php echo $user['User']['email']; ?>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-sm-6 invoice-col">
            <div class="box box-solid bg-navy">
                <div class="box-header">
                    <h3 class="box-title"> Thông tin hoạt động</h3>
                </div>
                <div class="box-body">
                    Username: <strong><?php echo $user['User']['username']; ?></strong><br>
                   
                    Lần đăng nhập cuối: <?php echo $user['User']['last_login']; ?><br>
                    Tình trạng: <?php echo $user['User']['activated']; ?><br>
                    <b>Số lớp đã hoàn thành:</b> <?php echo $user['User']['completedCourse']; ?><br>
                    <b>Số lớp chưa hoàn thành:</b> <?php echo $user['User']['uncompletedCourse']; ?><br>
                    <b>Số lớp đang đăng ký:</b> <?php echo $user['User']['registeringCourse']; ?><br/>
                    <b>Số lớp đã hủy:</b> <?php echo $user['User']['cancelledCourse']; ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>                                    
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Call of Duty</td>
                        <td>455-981-221</td>
                        <td>El snort testosterone trophy driving gloves handsome</td>
                        <td>$64.50</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Need for Speed IV</td>
                        <td>247-925-726</td>
                        <td>Wes Anderson umami biodiesel</td>
                        <td>$50.00</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Monsters DVD</td>
                        <td>735-845-642</td>
                        <td>Terry Richardson helvetica tousled street art master</td>
                        <td>$10.70</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Grown Ups Blue Ray</td>
                        <td>422-568-642</td>
                        <td>Tousled lomo letterpress</td>
                        <td>$25.99</td>
                    </tr>
                </tbody>
            </table>                            
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <img alt="Visa" src="../../img/credit/visa.png">
            <img alt="Mastercard" src="../../img/credit/mastercard.png">
            <img alt="American Express" src="../../img/credit/american-express.png">
            <img alt="Paypal" src="../../img/credit/paypal2.png">
            <p style="margin-top: 10px;" class="text-muted well well-sm no-shadow">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div><!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Amount Due 2/22/2014</p>
            <div class="table-responsive">
                <table class="table">
                    <tbody><tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>$250.30</td>
                        </tr>
                        <tr>
                            <th>Tax (9.3%)</th>
                            <td>$10.34</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$5.80</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>$265.24</td>
                        </tr>
                    </tbody></table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>  
            <button style="margin-right: 5px;" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate PDF</button>
        </div>
    </div>
</section>
<h2>Thông tin Tập huấn viên</h2>
<dl>
    <dt><?php echo __('Name'); ?></dt>
    <dd>
        <?php echo h($user['User']['name']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Username'); ?></dt>
    <dd>
        <?php echo h($user['User']['username']); ?>
        &nbsp;
    </dd>

    <dt><?php echo __('Email'); ?></dt>
    <dd>
        <?php echo h($user['User']['email']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Birthday'); ?></dt>
    <dd>
        <?php echo h($user['User']['birthday']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Birthplace'); ?></dt>
    <dd>
        <?php echo h($user['User']['birthplace']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Phone Number'); ?></dt>
    <dd>
        <?php echo h($user['User']['phone_number']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Address'); ?></dt>
    <dd>
        <?php echo h($user['User']['address']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Avatar'); ?></dt>
    <dd>
        <?php echo h($user['User']['avatar']); ?>
        &nbsp;

    <dt><?php echo __('Activated'); ?></dt>
    <dd>
        <?php echo h($user['User']['activated']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Last Login'); ?></dt>
    <dd>
        <?php echo h($user['User']['last_login']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Created'); ?></dt>
    <dd>
        <?php echo h($user['User']['created']); ?>
        &nbsp;
    </dd>

    <dt><?php echo __('Id'); ?></dt>
    <dd>
        <?php echo h($user['User']['id']); ?>
        &nbsp;
    </dd>
</dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Teaching Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Students Courses'), array('controller' => 'students_courses', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Students Course'), array('controller' => 'students_courses', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Related Courses'); ?></h3>
    <?php if (!empty($user['TeachingCourse'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Teacher Id'); ?></th>
                <th><?php echo __('Decription'); ?></th>
                <th><?php echo __('Max Enroll Number'); ?></th>
                <th><?php echo __('Session Number'); ?></th>
                <th><?php echo __('Is Published'); ?></th>
                <th><?php echo __('Is Cancelled'); ?></th>
                <th><?php echo __('Is Master Teaching'); ?></th>
                <th><?php echo __('Is Lock Grade Update'); ?></th>
                <th><?php echo __('Enrolling Expiry Date'); ?></th>
                <th><?php echo __('Grade Update Expiry Date'); ?></th>
                <th><?php echo __('Status'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Chapter Id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($user['TeachingCourse'] as $teachingCourse): ?>
                <tr>
                    <td><?php echo $teachingCourse['name']; ?></td>
                    <td><?php echo $teachingCourse['teacher_id']; ?></td>
                    <td><?php echo $teachingCourse['decription']; ?></td>
                    <td><?php echo $teachingCourse['max_enroll_number']; ?></td>
                    <td><?php echo $teachingCourse['session_number']; ?></td>
                    <td><?php echo $teachingCourse['is_published']; ?></td>
                    <td><?php echo $teachingCourse['is_cancelled']; ?></td>
                    <td><?php echo $teachingCourse['is_master_teaching']; ?></td>
                    <td><?php echo $teachingCourse['is_lock_grade_update']; ?></td>
                    <td><?php echo $teachingCourse['enrolling_expiry_date']; ?></td>
                    <td><?php echo $teachingCourse['grade_update_expiry_date']; ?></td>
                    <td><?php echo $teachingCourse['status']; ?></td>
                    <td><?php echo $teachingCourse['created']; ?></td>
                    <td><?php echo $teachingCourse['modified']; ?></td>
                    <td><?php echo $teachingCourse['id']; ?></td>
                    <td><?php echo $teachingCourse['chapter_id']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'courses', 'action' => 'view', $teachingCourse['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'courses', 'action' => 'edit', $teachingCourse['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'courses', 'action' => 'delete', $teachingCourse['id']), null, __('Are you sure you want to delete # %s?', $teachingCourse['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Teaching Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Students Courses'); ?></h3>
    <?php if (!empty($user['StudentsCourse'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Student Id'); ?></th>
                <th><?php echo __('Course Id'); ?></th>
                <th><?php echo __('Is Passed'); ?></th>
                <th><?php echo __('Is Recieved'); ?></th>
                <th><?php echo __('Certificated Date'); ?></th>
                <th><?php echo __('Certificated Number'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th><?php echo __('Id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($user['StudentsCourse'] as $studentsCourse): ?>
                <tr>
                    <td><?php echo $studentsCourse['student_id']; ?></td>
                    <td><?php echo $studentsCourse['course_id']; ?></td>
                    <td><?php echo $studentsCourse['is_passed']; ?></td>
                    <td><?php echo $studentsCourse['is_recieved']; ?></td>
                    <td><?php echo $studentsCourse['certificated_date']; ?></td>
                    <td><?php echo $studentsCourse['certificated_number']; ?></td>
                    <td><?php echo $studentsCourse['created']; ?></td>
                    <td><?php echo $studentsCourse['modified']; ?></td>
                    <td><?php echo $studentsCourse['id']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'students_courses', 'action' => 'view', $studentsCourse['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'students_courses', 'action' => 'edit', $studentsCourse['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'students_courses', 'action' => 'delete', $studentsCourse['id']), null, __('Are you sure you want to delete # %s?', $studentsCourse['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Students Course'), array('controller' => 'students_courses', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Groups'); ?></h3>
    <?php if (!empty($user['Group'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Image'); ?></th>
                <th><?php echo __('Image Path'); ?></th>
                <th><?php echo __('Decription'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th><?php echo __('Id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($user['Group'] as $group): ?>
                <tr>
                    <td><?php echo $group['name']; ?></td>
                    <td><?php echo $group['image']; ?></td>
                    <td><?php echo $group['image_path']; ?></td>
                    <td><?php echo $group['decription']; ?></td>
                    <td><?php echo $group['created']; ?></td>
                    <td><?php echo $group['modified']; ?></td>
                    <td><?php echo $group['id']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, __('Are you sure you want to delete # %s?', $group['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
