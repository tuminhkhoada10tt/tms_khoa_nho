<div class="col-md-8">
    <!-- WIDGET Thời khóa biểu hôm nay-->
    <?php echo $this->element('Widgets/student/today_schedule') ?>
    <!-- WIDGET CÁC KHÓA HỌC SẮP TỔ CHỨC-->
    <?php echo $this->element('Common/new_course',array('courses' => $courses)) ?>
</div>
<div class="col-md-4">
    <div class="row">
        <!--Khoa hoc moi dang ky-->
        <?php echo $this->element('Widgets/student/news',array('courses1' => $courses1)) ?>
        <!--WIDGET Thống kê-->
        <?php echo $this->element('Widgets/student/statistics') ?>
    </div>
</div>