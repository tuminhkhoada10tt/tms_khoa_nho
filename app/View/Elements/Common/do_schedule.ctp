<script>
    $(function() {
        var form = $('#addBuoiForm');
        var ten_buoi_tb = $('#new-event');
        var mau_nen_tb = $('#txt_background_color');
        var su_kien_hien_tai_selector = $('#txt_current_event');
        var uu_tien_tb = $('#pri-event');
        var phong_cb = $('#room-event');
        var nut_add = $('#add-new-event');
        var nut_sua = $('#edit-event');
        var nut_xoa = $('#delete-event');
        var nut_luu = $('#save-event');
        var nut_huy = $('#cancel-event');
        /**********************************************************/

        khoi_tao_color_picker();
        khoi_tao_full_canlendar();
        khoi_tao_su_kien($('#external-events div.external-event'));
        khoi_tao_form();
        khoi_tao_them();
        khoi_tao_huy();
        function khoi_tao_color_picker() {
            $('.demo').each(function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(hex, opacity) {
                        if (!hex)
                            return;
                        if (opacity)
                            hex += ', ' + opacity;
                    },
                    theme: 'bootstrap'
                });
            });
        }
        function khoi_tao_full_canlendar() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {//This is to add icons to the visible buttons
                    prev: "<span class='fa fa-caret-left'></span>",
                    next: "<span class='fa fa-caret-right'></span>",
                    today: 'Hôm nay',
                    month: 'tháng',
                    week: 'tuần',
                    day: 'ngày'
                },
                //Random default events
                //events: [],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventRender: function(event, element) {
                    var stDate = $.fullCalendar.formatDate(event.start, "hh:mm ngày dd-MM-yyyy");
                    var content = '<h3>' + event.name + '</h3>' +
                            '<p><b>Bắt đầu:</b> ' + stDate + '<br />' +
                            '<p><b>Thứ tự học:</b> ' + event.priority + '<br />' +
                            (event.room && '<p><b>Địa điểm:</b> ' + event.room + '</p>' || '');
                    element.qtip({
                        content: {
                            text: content
                        }
                    });
                },
                eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
                    alert('event.date:' + event.date + ' minuteDelta: ' + minuteDelta);
                    alert('dayDelta:' + dayDelta + ' minuteDelta: ' + minuteDelta);
                },
                eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view) {
                    alert(dayDelta);
                },
                drop: function(date, allDay) {
                    var originalEventObject = $(this).data('eventObject');
                    var copiedEventObject = sao_chep_su_kien($(this), originalEventObject, date, allDay);
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    $(this).remove();
                },
                eventClick: function(calEvent, jsEvent, view) {
                    xu_ly_click_su_kien(calEvent, jsEvent, view);
                },
            });
        }
        function khoi_tao_su_kien(ele) {
            ele.each(function() {
                var eventObject = {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    room: $(this).data('room'),
                    backgroundColor: $(this).data('color'),
                    borderColor: "#f56954", //red
                    name: $(this).data('name'),
                    priority: $(this).data('priority')
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            });
        }
        function sao_chep_su_kien(event, originalEventObject, date, allDay) {
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.id = event.data("id");
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = event.data("color");
            copiedEventObject.borderColor = event.css("border-color");
            copiedEventObject.room_id = event.data("room_id");
            copiedEventObject.room = event.data("room");
            copiedEventObject.name = event.data("name");
            return copiedEventObject;
        }
        /* Xử lý click lên 1 sự kiện trên canlendar*/
        function xu_ly_click_su_kien(cal_event, js_event, view) {
            khoi_tao_sua();
            //Thiết lập các giá trị cho form thêm buổi
            dien_gia_tri_form_tu_event(cal_event.id, cal_event.backgroundColor, cal_event.name, cal_event.priority, cal_event.room_id);


        }
        //Hàm xử lý khi nút edit-event được click
        function dien_gia_tri_form_tu_event(event_id, bg_color, name, priority, room_id) {
            su_kien_hien_tai_selector.val(event_id);
            console.log(su_kien_hien_tai_selector.val());
            mau_nen_tb.minicolors('value', bg_color);
            ten_buoi_tb.val(name);
            uu_tien_tb.val(priority);
            $("#room-event option[value='" + room_id + "']").attr('selected', 'selected');
        }
        function disable_form_input() {
            form.resetForm();
            ten_buoi_tb.attr('disabled', 'disabled');
            uu_tien_tb.attr('disabled', 'disabled');
            mau_nen_tb.attr('disabled', 'disabled');
            phong_cb.attr('disabled', 'disabled');
        }
        function khoi_tao_nut() {
            //Ẩn nút thêm
            nut_add.removeClass('disabled');
            nut_sua.addClass('disabled');
            nut_luu.addClass('disabled');
            nut_xoa.addClass('disabled');
            nut_huy.addClass('disabled');
        }
        function khoi_tao_form() {

            disable_form_input();
            khoi_tao_nut();
        }
        function khoi_tao_them() {
            nut_add.bind('click', function() {
                nut_add.addClass('disabled');
                ten_buoi_tb.removeAttr('disabled');
                uu_tien_tb.removeAttr('disabled');
                mau_nen_tb.removeAttr('disabled');
                phong_cb.removeAttr('disabled');
                nut_luu.removeClass('disabled');
                nut_huy.removeClass('disabled');
                nut_sua.addClass('disabled');
                nut_xoa.addClass('disabled');
            });
        }
        function khoi_tao_sua() {
            nut_add.addClass('disabled');
            nut_luu.addClass('disabled');
            nut_sua.removeClass('disabled');
            nut_xoa.removeClass('disabled');
            nut_huy.addClass('disabled');
            ten_buoi_tb.attr('disabled', 'disabled');
            uu_tien_tb.attr('disabled', 'disabled');
            mau_nen_tb.attr('disabled', 'disabled');
            phong_cb.attr('disabled', 'disabled');
            nut_sua.off('click');
            nut_sua.bind('click', function() {
                ten_buoi_tb.removeAttr('disabled');
                uu_tien_tb.removeAttr('disabled');
                mau_nen_tb.removeAttr('disabled');
                phong_cb.removeAttr('disabled');
                nut_luu.removeClass('disabled');
                nut_huy.removeClass('disabled');
                nut_sua.addClass('disabled');
                nut_xoa.addClass('disabled');
            });
        }
        function khoi_tao_huy() {
            nut_huy.bind('click', function() {
                khoi_tao_form();
            });
        }

        //form.removeAttr('onsubmit');
        form.on('submit', function(e) {
            e.preventDefault();
            //Create vars
            var current_event_id = su_kien_hien_tai_selector.val();
            //Check if value found
            if (current_event_id) {                 //Retrieve current event

                var current_event = $('#calendar').fullCalendar('clientEvents', current_event_id);
                //Check if found
                if (current_event && current_event.length == 1) {
                    //Retrieve current event from array
                    current_event = current_event[0];
                    //Set values
                    current_event.backgroundColor = mau_nen_tb.val();
                    current_event.name = ten_buoi_tb.val();
                    current_event.title = ten_buoi_tb.val();
                    current_event.textColor = '#fff';
                    current_event.borderColor = mau_nen_tb.val();
                    current_event.room_id = phong_cb.val();
                    current_event.room = $("#room-event option:selected").text();
                    current_event.priority = uu_tien_tb.val();
                    current_event.color = mau_nen_tb.val();
                    //Update event
                    var options = {
                        //target: '#output2', // target element(s) to be updated with server response 
                        success: function(responseText, statusText, xhr, $form) {
                            if (responseText.response.status) {
                                $('#calendar').fullCalendar('updateEvent', current_event);
                            } else {
                                var error = responseText.response.message;
                                bootstrap_alert(error, 'warning');
                            }
                        }, // post-submit callback 
                        // other available options: 
                        url: '/courses_rooms/' + current_event.id + '.json', // override for form's 'action' attribute 
                        type: 'put', // 'get' or 'post', override for form's 'method' attribute 
                        //resetForm: true, // reset the form after successful submit
                        timeout: 3000
                    };
                    $(this).append('<input type="hidden" name="data[CoursesRoom][course_id]" value="' + <?php echo $course_id; ?> + '">');
                    $(this).ajaxSubmit(options);
                    return false;
                }
            } else {
                form.append('<input type="hidden" name="data[CoursesRoom][course_id]" value="<?php echo $course_id; ?>">');
                form.ajaxSubmit({
                    url: '/courses_rooms/add.json',
                    success: addBuoiResponse
                });
            }

        });
        nut_sua.on('click', function() {
            console.log('nut_sua.on(click)');
            //nut_sua.off('click');
        });
        nut_luu.on('click', function() {
            console.log('nut_luu.on(click)');
            //nut_luu.off('click');
        });
        /* ADDING EVENTS */
        function remote_add_event() {
            form.on('submit', function(e) {
                $(this).append('<input type="hidden" name="data[CoursesRoom][course_id]" value="<?php echo $course_id; ?>">');
                e.preventDefault();
                $(this).ajaxSubmit({
                    url: '/courses_rooms/add.json',
                    success: addBuoiResponse
                });
            });
        }
        function addBuoiResponse(responseText, statusText, xhr, $form) {
            if (responseText.response.status) {
                var event = $("<div />");
                event.css(
                        {
                            "id": responseText.response.id,
                            "background-color": responseText.response.currColor,
                            "border-color": responseText.response.currColor,
                            "color": "#fff"
                        }).addClass("external-event");
                event.attr('data-room', responseText.response.room);
                event.attr('data-name', responseText.response.name);
                event.attr('data-room_id', responseText.response.room_id);
                event.attr('data-priority', responseText.response.priority);
                event.attr('data-color', responseText.response.currColor);
                event.html(responseText.response.name);
                $('#external-events').prepend(event);
                //Thêm khả năng kéo thả
                khoi_tao_su_kien(event);
            } else {
                var error = responseText.response.message;
                bootstrap_alert(error, 'warning');
            }

            return true;
        }
        function bootstrap_alert(message, type) {
            if (type == 'warning')
                $('#message').append('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Cảnh báo</h4>' + message + '</div>');
            else
                $('#message').append('<div class="alert alert-block alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Info!</h4>' + message + '</div>');
            alertTimeout(3000); //and here
        }
        function alertTimeout(wait) {
            setTimeout(function() {
                $('#message').children('.alert:first-child').remove();
            }, wait);
        }
    });
</script>