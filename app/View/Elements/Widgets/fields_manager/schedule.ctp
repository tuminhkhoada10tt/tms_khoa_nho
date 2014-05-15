<?php
echo $this->Html->script('jquery.form');
echo $this->Html->css('/jquery.qtip.custom/jquery.qtip.min');
echo $this->Html->script('/jquery.qtip.custom/jquery.qtip.min');
echo $this->Html->script('jquery.minicolors.min');
echo $this->Html->css('jquery.minicolors');
?>

<div class="row">
    <div id='message'></div>
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Buổi</h4>
            </div>
            <div class="box-body">
                <!-- the events -->
                <div id='external-events'>  
                    <?php foreach ($course['Buoi'] as $buoi): ?>

                        <div class='external-event' style="background-color: <?php echo $buoi['color']; ?>" 
                             data-id='<?php echo $buoi['id']; ?>' 
                             data-room='<?php echo $buoi['Room']['name']; ?>' 
                             data-room_id='<?php echo $buoi['room_id']; ?>'
                             data-name='<?php echo $buoi['name']; ?>' 
                             data-priority='<?php echo $buoi['priority']; ?>' 
                             data-color='<?php echo $buoi['color']; ?>'
                             > 
                                 <?php echo $buoi['name']; ?>
                        </div>                    
                    <?php endforeach; ?>
                    
                </div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Thêm buổi</h3>    
            </div>
            <div class="box-body">
                <?php echo $this->Form->create('CoursesRoom', array('id' => 'addBuoiForm')); ?>  

                <label for="hue-demo">Màu nền</label>
                <input type="text" id="txt_background_color" class="form-control demo" data-control="hue" name="data[CoursesRoom][color]" value="#ff6161">

                <?php echo $this->Form->input('name', array('label' => false, 'id' => 'new-event', 'class' => 'form-control', 'placeholder' => "Tên buổi, vd: buổi 1, buổi 2")); ?>
                <?php echo $this->Form->input('priority', array('label' => false, 'id' => 'pri-event', 'class' => 'form-control', 'placeholder' => "Thứ tự học, ví dụ: 1, 2, 3")); ?>
                <input id="txt_current_event" type="hidden" value="" />
                <div class="input-group">
                    <?php echo $this->Form->input('room_id', array('label' => false, 'div' => false, 'id' => 'room-event', 'class' => 'form-control', 'empty' => "Chọn phòng..")); ?>
                    <span class="input-group-addon"><a href="/rooms/add" class="fancybox.ajax add-button"><i class="glyphicon glyphicon-plus"></i></a></span>
                </div>

                <button id="add-new-event" type="submit" class="btn btn-info">Thêm</button>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">                                
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
</div><!-- /.row -->  