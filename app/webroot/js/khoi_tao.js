function khoi_tao_su_kien(ele) {
    //console.log(ele);
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
                    (event.room && '<p><b>Địa điểm:</b> ' + event.room + '</p>' || '');
            element.qtip({
                content: {
                    text: content
                }
            });
        },
        drop: function(date, allDay) { // this function is called when something is dropped
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.id = $(this).data("id");
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).data("color");
            copiedEventObject.borderColor = $(this).css("border-color");
            copiedEventObject.room_id = $(this).data("room_id");
            copiedEventObject.room = $(this).data("room");
            copiedEventObject.name = $(this).data("name");
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            $(this).remove();
        },
        eventClick: function(calEvent, jsEvent, view) {
            calendar_event_clicked(calEvent, jsEvent, view);
        }
    });
}//Hàm xử lý khi nút edit-event được click
$('#edit-event').on('click', function() {
    edit_click();
});
$('#cancel-event').on('click', function() {
    cancel_event_click();
});
/* Xử lý click lên 1 sự kiện trên canlendar*/
function calendar_event_clicked(cal_event, js_event, view) {
    //Ẩn nút thêm
    $('#add-new-event').addClass('disabled');
    $('#save-event').addClass('disabled');
    $('#new-event').attr('disabled', 'disabled');
    $('#pri-event').attr('disabled', 'disabled');
    $('#txt_background_color').attr('disabled', 'disabled');
    $('#room-event').attr('disabled', 'disabled');
    //Thiết lập các giá trị cho form thêm buổi
    dien_gia_tri_form_tu_event(cal_event.id, cal_event.backgroundColor, cal_event.name, cal_event.priority, cal_event.room_id);
}
function initialise_update_event() {
    var test = $('#calendar').fullCalendar('clientEvents');
    //Bind event
    $('#edit-event').bind('click', function() {
        //Create vars
        var current_event_id = $('#txt_current_event').val();
        //Check if value found
        if (current_event_id) {
            //Retrieve current event
            var current_event = $('#calendar').fullCalendar('clientEvents', current_event_id);
            //Check if found
            if (current_event && current_event.length == 1) {
                //Retrieve current event from array
                current_event = current_event[0];
                //Set values
                current_event.backgroundColor = $('#txt_background_color').val();
                current_event.textColor = $('#txt_text_color').val();
                current_event.borderColor = $('#txt_border_color').val();
                current_event.title = $('#txt_title').val();
                current_event.description = $('#txt_description').val();
                current_event.price = $('#txt_price').val();
                current_event.available = $('#txt_available').val();
                //Update event
                $('#calendar').fullCalendar('updateEvent', current_event);
            }
        }
    });
}
/* ADDING EVENTS */
var form = $('#addBuoiForm');
form.on('submit', function(e) {
    $(this).append('<input type="hidden" name="data[CoursesRoom][course_id]" value="<?php echo $course_id; ?>">');
    e.preventDefault();
    $(this).ajaxSubmit({
        url: '/courses_rooms/add.json',
        success: addBuoiResponse
    });
    return false;
});
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
        $('#message').html(error);
    }
    return true;
}
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
//Trạng thái các nút thao tác của form lúc ban đầu;
function cancel_event_click() {
    $('#save-event').addClass('disabled');
    disable_form_input();
    //Ẩn nút thêm
    $('#add-new-event').removeClass('disabled');
    $('#edit-event').addClass('disabled');

    $('#save-event').addClass('disabled');
    $('#delete-event').addClass('disabled');
    $('#cancel-event').addClass('disabled');
}
function edit_click() {
    $('#save-event').removeClass('disabled');
    $('#new-event').removeAttr('disabled');
    $('#pri-event').removeAttr('disabled');
    $('#txt_background_color').removeAttr('disabled');
    $('#room-event').removeAttr('disabled');
    //Ẩn nút thêm
    $('#add-new-event').addClass('disabled');
    $('#save-event').removeClass('disabled');
    $('#delete-event').addClass('disabled');
    $('#cancel-event').removeClass('disabled');
}

function disable_form_input() {
    $('#new-event').attr('disabled');
    $('#pri-event').attr('disabled');
    $('#txt_background_color').attr('disabled');
    $('#room-event').attr('disabled');
}

function dien_gia_tri_form_tu_event(event_id, bg_color, name, priority, room_id) {
    $('#txt_current_event').val(event_id);
    $('#txt_background_color').minicolors('value', bg_color);
    $('#new-event').val(name);
    $('#pri-event').val(priority);
    $("#room-event option[value='" + room_id + "']").attr('selected', 'selected');
}